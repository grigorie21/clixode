<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BucketFile extends Model
{
    public $timestamps = true;
    protected $table = 'bucket_file';
    protected $fillable = ['title'];

    protected $casts = [
        'created_at' => 'd.m.Y H:i:s',
        'updated_at' => 'd.m.Y H:i:s',
    ];
}
