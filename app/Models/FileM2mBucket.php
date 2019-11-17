<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FileM2mBucket extends Model
{
    public $timestamps = false;

//todo
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    protected $table = 'file_m2m_bucket';
    protected $fillable = ['file_id', 'bucket_id', 'name'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function files() {
        return $this->belongsTo(File::class,  'file_id', 'id');
    }
    public function bucketFile() {
        return $this->belongsTo(BucketFile::class,  'bucket_id', 'id');
    }
}
