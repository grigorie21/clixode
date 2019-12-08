<?php

namespace App\Jobs;

use App\Models\BucketFile;
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
    public $id;
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
                $this->id = $task->id;
            }

            if ((time() - $this->time) >= 1) {
                $this->time = time();

                if ($this->firstRecord) {
                    if ($this->id) {
                        $task = HttpDownloadTask::find($this->id)->update([
                            'progress' => $progress,
                        ]);
                    }
                }
            }
        }

        if ($progress > $previousProgress) {
            $previousProgress = $progress;

            if ($progress == 100) {
                DB::transaction(function () use ($download_size, $progress) {

                    HttpDownloadTask::find($this->id)->update(['progress' => $progress]);

                    $file = File::create([
                        'source_name' => 1,
                        'sha256' => uniqid(),
                        'size' => $download_size,
                        'slug' => uniqid(),
                    ]);

                    FileM2mBucket::create([
                        'file_id' => $file->id,
                        'bucket_id' => $this->bucket,
                        'name' => 7,
                    ]);
                });
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
        $targetFile = fopen( $oldFilename, 'w+');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOPROGRESS, false);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, [$this, 'progress']); //посмотреть
        curl_setopt($ch, CURLOPT_FILE, $targetFile);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        $response = curl_exec($ch);

        // Retudn headers seperatly from the Response Body
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

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
                rename($oldFilename, "file_{$this->id}");
            }
        }
    }
}
