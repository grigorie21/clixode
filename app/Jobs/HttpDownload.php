<?php

namespace App\Jobs;

use App\Models\File;
use App\Models\HttpDownloadTask;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HttpDownload implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $time;
    public $firstRecord;
    public $id;
    public $url;
    public $bucket;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $bucket)
    {
        $this->time = time();
        $this->url = $url;
        $this->bucket = $bucket;
    }

    /**
     * Downloading file function
     *
     * @param $resource resource this param may be removed in new versions of CURL
     * @param $download_size
     * @param $downloaded_size
     * @param $upload_size
     * @param $uploaded_size
     */
    function progress($resource, $download_size, $downloaded_size, $upload_size, $uploaded_size)
    {
        static $previousProgress = 0;

        if ($download_size == 0) {
            $progress = 0;
        } else {
            $progress = round($downloaded_size / $download_size * 100, 2, PHP_ROUND_HALF_DOWN);

            if ((time() - $this->time) >= 1) {
                $this->time = time();

                if (!$this->firstRecord) {
                    $task = HttpDownloadTask::create([
                        'url' => $this->url,
                        'status_id' => '1',
                        'progress' => $progress,
                    ]);
                    $this->firstRecord = true;
                    $this->id = $task->id;
                } else {
                    if ($this->id) {
                        HttpDownloadTask::find($this->id)->update([
                            'progress' => $progress,
                        ]);
                    }
                }
            }
        }

        if ($progress > $previousProgress) {
            $previousProgress = $progress;
            $fp = fopen('progress.txt', 'a');
            fputs($fp, "$progress\n");
            fclose($fp);

            if ($progress == 100) {
                HttpDownloadTask::find($this->id)->update([
                    'progress' => $progress,
                ]);

                File::create();


            }
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $targetFile = fopen('testfile.iso', 'w');
        $ch = curl_init($this->url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOPROGRESS, false);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, [$this, 'progress']);
        curl_setopt($ch, CURLOPT_FILE, $targetFile);
        curl_exec($ch);

        fclose($targetFile);
    }
}
