<?php

namespace App\Jobs;

use App\Models\File;
use App\Models\FileM2mBucket;
use App\Models\HttpDownloadTask;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class HttpDownload implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $time;
    public $firstRecord;
    public $taskId;
    public $url;
    public $bucket;
    public $errors;

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

            if (!$this->firstRecord) {
                $task = HttpDownloadTask::create([
                    'url' => $this->url,
                    'status_id' => '1',
                    'progress' => $progress,
                ]);
                $this->firstRecord = true;
                $this->taskId = $task->id;
            }

            if ((time() - $this->time) >= 1) {
                $this->time = time();

                if ($this->firstRecord && $progress > $previousProgress) {
                    $previousProgress = $progress;
                    if ($this->taskId) {
                        HttpDownloadTask::find($this->taskId)->update([
                            'progress' => $progress,
                        ]);
                    }
                }
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
        $oldFilename = 'file';
        $targetFile = fopen($oldFilename, 'w+');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOPROGRESS, false);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, [$this, 'progress']); //посмотреть
        curl_setopt($ch, CURLOPT_FILE, $targetFile);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        if (($response = curl_exec($ch)) !== false) {
            if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
                $filename = null;
                $reDispo = '/^Content-Disposition: .*?filename=(?<f>[^\s]+|\x22[^\x22]+\x22)\x3B?.*$/m';

                if (preg_match($reDispo, $response, $mDispo)) {
                    $filename = trim($mDispo['f'], ' ";');
                }

                if (!$filename) {
                    $filename = basename($this->url);
                }

                if (rename($oldFilename, "file_{$this->taskId}")) {
                    $hash = hash_file("sha512", "file_{$this->taskId}");
                    DB::transaction(function () use ($filename, $hash) {

                        HttpDownloadTask::find($this->taskId)->update([
                            'progress' => 100,
                            'status_id' => 10
                        ]);
                        $file = File::create([
                            'name' => $filename,
                            'sha512' => $hash,
                            'size' => filesize("file_{$this->taskId}"),
                            'slug' => uniqid(),
                        ]);
                        FileM2mBucket::create([
                            'file_id' => $file->id,
                            'bucket_id' => $this->bucket,
                            'name' => $file->slug,
                        ]);
                    });
                }
            }
        }
    }
}
