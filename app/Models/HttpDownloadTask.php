<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HttpDownloadTask extends Model
{
    public $timestamps = true;
    protected $table = 'http_download_task';
    protected $fillable = [
        'url',
        'ref_http_download_task_status_id',
        'progress',
        'bucket_id',
    ];

}
