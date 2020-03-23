<?php
namespace App\Library\Services;
use File;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class DownloadImg {
    public function saveMedia($request, $medias) {
        if (empty($medias)) {
            return false;
        }

        $prefix = $request['social'] ? 'ig_' : 'tw_';
        $nameFile = $prefix . $request->input('username') .'.'. $request->input('date_req');
        $path =  storage_path() . '/app/public/tmp/' . $nameFile;
        $zipPath = storage_path() . '/app/public/tmp/' . $nameFile . '.zip';
        File::makeDirectory($path, 0777, true, true);

        // save to folder
        $this->checkMedia($medias, $path, $request);

        //compress the folder
        $this->zipDir($path, $zipPath, $nameFile);

        //Download file
        return $this->downloadFileImg($path, $zipPath);
    }

    public function checkMedia($medias, $path, $request) {
        foreach ($medias as $key => $item) {
            if ($request->input('social') == true && null !== $item["media_url"]) {
                $url = $item["media_url"];
                $ext = pathinfo(parse_url($item["media_url"])["path"], PATHINFO_EXTENSION);
            }

            if ($request->input('social') == false && null !== $item->extended_entities->media[0]->media_url_https) {
                $url = $item->extended_entities->media[0]->media_url_https;
                $ext = pathinfo($item->extended_entities->media[0]->media_url_https, PATHINFO_EXTENSION);
            }

            if (isset($url) && !empty($url)) {
                $dateReq = date("mY", strtotime($request->input('date_req')));
                $nameImg = $dateReq . '-' . $key . '.' . $ext;
                $this->saveToFolder(array(
                    'url'   => $url,
                    'name'  => $nameImg
                ),
                    $path
                );
            }
        }
    }

    /*
     * save image to folder
     * @param $img array image object info
     * @param $path string director save img
     */
    public function saveToFolder($img, $path) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $img['url']);
        $data = curl_exec($ch);
        curl_close($ch);

        $fp = $path . '/' . $img['name'];
        file_put_contents($fp, $data);

        return $data;
    }

    /**
     * Zip a folder (include itself).
     * @param string $sourcePath Path of directory to be zip.
     * @param string $outZipPath Path of output zip file.
     */
    public function zipDir($sourcePath, $outZipPath, $nameFile) {
        $zip = new ZipArchive;
        if ($zip->open(($outZipPath), ZipArchive::CREATE) === TRUE) {
            $files = File::files($sourcePath);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $nameFile.'/'.$relativeNameInZipFile);
            }
            $zip->close();
        }
    }

    public function downloadFileImg($path, $zipPath) {
        if (file_exists($zipPath)) {
            $headers = [
                'Content-Type: application/zip',
                'Content-Disposition: attachment; filename="' . $zipPath . '"',
                'Content-Length: ' . filesize($zipPath)
            ];
            File::deleteDirectory($path);
            Return \Response::download($zipPath, basename($zipPath), $headers)->deleteFileAfterSend();
        }
    }
}