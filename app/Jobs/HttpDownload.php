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
    public $taskId;
    public $url;
    public $bucket;
    public $errors;

    /**
     * Create a new job instance
     *
     * HttpDownload constructor.
     * @param $taskId
     * @param $bucketId
     */
    public function __construct($taskId)
    {
        $this->time = time();

        $this->taskId = $taskId;

        $task = HttpDownloadTask::find($taskId);

        $this->url = $task->url;
        $this->bucket = $task->bucket_id;
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

                if (
                    $progress > $previousProgress) {
                    $previousProgress = $progress;

                    if ($this->taskId) {
                        HttpDownloadTask::find($this->taskId)->update(['progress' => $progress]);
                    }
                }
            }
        }
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $fileName = "file_{$this->taskId}";
        $targetFile = fopen($fileName, 'w+');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOPROGRESS, false);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, [$this, 'progress']);
        curl_setopt($ch, CURLOPT_FILE, $targetFile);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        if (($response = curl_exec($ch)) !== false) {
            if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
                $sourceFileName = null;
                $headerFilename = '/^Content-Disposition: .*?filename=(?<f>[^\s]+|\x22[^\x22]+\x22)\x3B?.*$/m';

                if (preg_match($headerFilename, $response, $matches)) {
                    $sourceFileName = trim($matches['f'], ' ";');
                }

                if (!$sourceFileName) {
                    $sourceFileName = basename($this->url);
                }

                $hash = hash_file('sha512', $fileName);

                DB::transaction(function () use ($sourceFileName, $hash, $fileName) {
                    HttpDownloadTask::find($this->taskId)->update([
                        'progress' => 100,
                        'ref_http_download_task_status_id' => 10,
                    ]);

                    $file = File::create([
                        'name' => $sourceFileName,
                        'sha512' => $hash,
                        'size' => filesize($fileName),
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
