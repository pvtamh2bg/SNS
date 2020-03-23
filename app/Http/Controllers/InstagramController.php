<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Support\Facades\Log;
use App\Library\Services\DownloadImg;

class InstagramController extends Controller {
    const HEAD_GRAPH_LINK = 31;

    private $__api;
    private $__errMessage = '';
    private $__medias = [];


    public function __construct(Facebook $fb) {
        $this->middleware(function($request, $next) use ($fb) {
            $fb->setDefaultAccessToken(session()->get('user-token'));
            $this->__api = $fb;
            return $next($request);
        });
    }

    public function getMedias() {
        return $this->__medias;
    }

    public function index(Request $request) {
        $this->__getMedias($request);

        return $this->getMedias();
    }

    /**
     *
     * GET information of user logged
     *
     * @param $ig_id
     *
     * @return array
     */
    public function retrieveUserProfile($ig_id) {

        try {
            $user = $this->__api->get('/' . $ig_id . '?fields=id,name,username')->getGraphNode()->asArray();
            return $user;
        } catch (FacebookSDKException $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     *
     * GET All Business account of list page
     *
     * @return array|bool
     */
    public function getListPageConnected() {
        try {
            $pages = $this->__api->get('/me/accounts?fields=id,name,instagram_business_account{username,name,profile_picture_url}')->getGraphEdge()->asArray();

            ### Get list pages has connected Instagram business account
            $tmp_pages = [];
            foreach ($pages as $page) {
                if (isset($page['instagram_business_account'])) {
                    $tmp_pages[] = $page;
                }
            }

            return $tmp_pages;
        } catch (FacebookSDKException $e) {
            Log::info($e->getMessage());

            return false;
        }
    }

    /**
     *
     * GET Account Business Account connect with page
     *
     * @param $pageID
     *
     * @return bool
     */
    private function __getIdInstagram($pageID) {
        try {
            $data = $this->__api->get('/' . $pageID . '?fields=instagram_business_account')->getGraphEdge()->asArray();
            if (isset($data['instagram_business_account']['id'])) {
                return $data['instagram_business_account']['id'];
            }
        } catch (FacebookSDKException $e) {
            Log::info($e->getMessage());

            return false;
        }
    }

    /**
     *
     * GET All Media Instagram Social
     *
     * @param Request $request
     * @param null $next
     * @param bool $download
     *
     * @return array|bool
     */
    public function __getMedias(Request $request, $next = null, $download = false) {

        if (!$request->input('ig_user_id') || !$request->input('date_req'))
            return false;

        $path = (is_null($next)) ? '/' . $request->input('ig_user_id') . '/media?fields=caption,media_type,media_url,timestamp,like_count,comments_count,username&limit=100' : $next;

        try {
            $data = $this->__api->get($path)->getDecodedBody();

            $endMediaObject = end($data['data']);
            $timestamp_create_at = new \DateTime($endMediaObject['timestamp']);
            $dateRq = new \DateTime($request->input('date_req'));

            if ($timestamp_create_at->getTimestamp() < $dateRq->getTimestamp()) {
                $this->__medias = array_merge($this->__medias, $this->__filterData($data['data'], $request->input('date_req'), $download));

                return $this->__medias;
            } else {
                $this->__medias = array_merge($this->__medias, $this->__filterData($data['data'], $request->input('date_req'), $download));
                if (!isset($data['paging']['next']))
                    return false;
                $next = substr($data['paging']['next'], self::HEAD_GRAPH_LINK);
                $this->__getMedias($request, $next);
            }

        } catch (FacebookSDKException $e) {
            Log::info($e->getMessage());

            return false;
        }
    }

    /**
     *
     * Filter data
     *
     * @param $tweets array Data get from API
     * @param $date string Date request
     *
     * @return array
     */
    private function __filterData($data, $date, $download = false) {
        if (!$data || empty($data))
            return false;

        $tmp = [];

        foreach ($data as $key => $item) {
            if ($download) {
                if ($item['media_type'] !== 'IMAGE')
                    continue;
            }

            if (strtotime(date('Y-m', strtotime($item['timestamp']))) == strtotime($date)) {
                $item['timestamp'] = date('H:s . Y/m/d', strtotime($item['timestamp']));
                $tmp[] = $item;
            }
        }

        return $tmp;
    }

    /**
     *
     * Download Image Follow request
     *
     * @param Request $request
     * @param DownloadImg $download
     *
     * @return bool
     */
    public function downloadImg(Request $request, DownloadImg $download) {
        if (!$request->input('ig_user_id') || !$request->input('username') || !$request->input('date_req'))
            return false;

        return $download->saveMedia($request, $this->__getMedias($request, null, true));
    }
}
