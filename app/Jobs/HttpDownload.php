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
        if (!isset($this->error)) {
//            info(1);
//            dd(1);
//        if ($this->error) {
//        if ($this->error == 33 ) {
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
                    DB::transaction(function () use ($download_size, $progress) {

                        HttpDownloadTask::find($this->id)->update(['progress' => $progress]);
                        $file = File::create([
                            'source_name' => 1,
                            'sha256' => uniqid(),
                            'size' => $download_size,
                            'slug' => uniqid(),
                        ]);
                        $bucketId = BucketFile::where('slug', $this->bucket)->first()->id;
                        FileM2mBucket::create([
                            'file_id' => $file->id,
                            'bucket_id' => $bucketId,
                            'name' => 11
                        ]);
                    }, 5);
                }
            }
//        } else {
////            dd($this->error);
        }
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        try {
            $targetFile = fopen(basename($this->url) . '1', 'w+');
            $ch = curl_init($this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_NOPROGRESS, false);
            curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, [$this, 'progress']); //посмотреть
            curl_setopt($ch, CURLOPT_FILE, $targetFile);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);

            curl_exec($ch);

            if (curl_errno($ch)) {
                $this->error = curl_errno($ch);
                unlink(basename($this->url) . '1');
                unlink('wwwww.txt');
                dd(12);


                info(555);
//            $fp = fopen('wwww.txt', 'w+');
//            fputs($fp, "progress\n");
//            fclose($fp);
            }

            curl_close($ch);

            fclose($targetFile);
//        } catch (\Exception $e){
//            unlink(basename($this->url) . '1');
//            unlink('wwwww.txt');
//
//            info(555);
//        }
    }
}
