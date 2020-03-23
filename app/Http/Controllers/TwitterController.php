<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

use Abraham\TwitterOAuth\TwitterOAuth;
use Mockery\Exception;

use App\Http\Resources\Tweet as TweetResource;

use App\Library\Services\DownloadImg;

class TwitterController extends Controller {

    const  TIME_GET_TWEET = 16;

    private $__count_time_get_tweet = 0;

    private $__tokenNum = 0;
    private $__errMessage = "";
    private $__tweets = [];

    /*
     * get list tweet from user request
     * @param $request String Get username and date request
     */
    public function index(Request $request) {
        $this->__getTweets($request);
        return TweetResource::collection($this->__tweets)->additional(
            ['meta' => [
                'messages' => $this->__errMessage
                ]
            ]);
    }

    /*
     * get tweet from api
     * @param $request List params
     * return object
     */
    private function __getTweets($request, $max_id = null, $download = false) {
        if (++$this->__count_time_get_tweet > self::TIME_GET_TWEET ) {
            $this->__errMessage = 'Don\'t have any tweets or total number of tweets of the '.date('m/Y', strtotime($request->input('date_req'))).' exceeded limit the availability';
            return false;
        }

        $options = array(
            'screen_name' => $request->input('username'),
            'include_rts' => false,
            'exclude_replies' => true,
            'count' => 200
        );

        if ($max_id !== null) {
            $options['max_id'] = $max_id;
        }

        $tweets = $this->__apiGet('statuses/user_timeline', $options);

        // Rate limit exceeded
        if ($tweets == 88) {
            $this->__tokenNum++;
            if ($this->__tokenNum == 2) {
                $this->__tokenNum = 0;
            }
            Log::debug("<error>Fail: </error>" . $this->__errMessage);
            $this->__getTweets($request, $max_id);
        }

        if ($tweets === false || (!isset($tweets) && empty($tweets))) {
            Log::debug("<error>Fail: </error>" . $this->__errMessage);
            return;
        }

        $endTW = end($tweets);
        $timestamp_create_at = new \DateTime($endTW->created_at);
        $dateRq = new \DateTime($request->input('date_req'));

        if ($timestamp_create_at->getTimestamp() < $dateRq->getTimestamp()) {
            $this->__tweets = array_merge($this->__tweets,$this->__filterData($tweets, $request->input('date_req'), $download));
            return $this->__tweets;
        }else{
            $max_id = end($tweets)->id;
            array_pop($tweets);
            $this->__tweets = array_merge($this->__tweets,$this->__filterData($tweets, $request->input('date_req'), $download));
            $this->__getTweets($request, $max_id);
        }
    }

    /*
     * get info user
     * @param $request String Get username from request
     * @return json
     */
    public function getProfile(Request $request) {
        $username = $request->input('username');
        if (!isset($username) && empty($username)) {
            return false;
        }
        $option = array(
            'screen_name' => $username
        );

        $info = $this->__apiGet('users/show', $option);
        return json_encode($info);
    }

    /*
     * get data from api
     * @param $path String Endpoint in API
     * @param $option array List param for get api
     * @return object
     */
    private function __apiGet($path, $option) {
        $connection = new TwitterOAuth(
            Config::get("apiConst.twitter.token.$this->__tokenNum.consumer_key"),
            Config::get("apiConst.twitter.token.$this->__tokenNum.consumer_secret"),
            Config::get("apiConst.twitter.token.$this->__tokenNum.access_token"),
            Config::get("apiConst.twitter.token.$this->__tokenNum.access_token_secret")
        );

        try {
            $res = $connection->get($path, $option);
        } catch (Exception $e) {
            $this->__errMessage = $e->getMessage();
            return false;
        }

        if (isset($res->errors)) {
            // Rate limit exceeded
            if (($res->errors[0]->code) == 88) {
                $this->__errMessage .= ($this->__errMessage === "" ? "" : ", ") . $res->errors[0]->message;
                return $res->errors[0]->code;
            }

            foreach ($res->errors as $item) {
                $this->__errMessage .= ($this->__errMessage === "" ? "" : ", ") . $item->message;
            }
            return false;
        }
        return $res;
    }

    /*
     * Filter data, only image
     * @param $tweets array Data get from API
     * @param $date string Date request
     * return array
     */
    private function __filterData($tweets, $date, $download = false) {
        if (!isset($tweets) && empty($tweets)) {
            return null;
        }
        $result = array();
        foreach ($tweets as $val) {
            // retweeted_status: bài viết dc tweet lại của other user
            if(isset($val->retweeted_status)) continue;
            if($download){
                if (!isset($val->extended_entities) || $val->extended_entities->media[0]->type === "video" || $val->extended_entities->media[0]->type === "animated_gif") {
                    continue;
                }
            }
            $dateSocail = date('Y-m', strtotime($val->created_at));
            if (strtotime($dateSocail) === strtotime($date)) {
                $result[] = $val;
            }
        }
        return $result;
    }

    /*
     * download image allow month
     * @param $username string get from url
     * @param $date_req string get from url
     * return void
     */
    public function downloadImg(Request $request, DownloadImg $download) {
        if( !$request->input('username') || !$request->input('date_req')){
            return false;
        }
        return $download->saveMedia($request, $this->__getTweets($request, null, true));
    }
}
