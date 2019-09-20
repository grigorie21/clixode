<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BucketImage extends Model
{
    public $timestamps = true;
    protected $table = 'bucket_image';
    protected $fillable = ['title'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }
}
