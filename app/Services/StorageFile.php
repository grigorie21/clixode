<?php

namespace App\Services;


use App\Contracts\StorageFile as StorageFileContract;
use App\Models\BucketFile;
use App\Models\File;
use App\Models\FileM2MBucket;
use Illuminate\Support\Facades\DB;

class StorageFile implements StorageFileContract
{
    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function url(string $url)
    {
        dd('Add file by url');
    }

    public function upload(int $bucketId, string $path, string $name)
    {
        try {
            $bucket = BucketFile::find($bucketId);
            $sha256 = hash_file('sha256', $path);
            $fileSize = filesize($path);

            if (!$bucket || !$sha256 || !$fileSize) {
                return false;
            }

            DB::beginTransaction();
            $file = File::where('sha256', $sha256)->first();

            if (!$file) { // Файл ранее не был загружен
                copy($path, "{$this->store->dstDir($sha256)}/{$sha256}");

                $file = File::create([
                    'source_name' => $name,
                    'sha256' => $sha256,
                    'size' => $fileSize,
                ]);
            }

            do {
                $saveFileCounter = isset($saveFileCounter) ? ++$saveFileCounter : 0;
                $saveFileResult = $bucket->files()->save($file, [
                    'name' => $name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'slug' => $this->store->randomSlug(),
                ]);
            } while (!$saveFileResult && $saveFileCounter < 100);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
