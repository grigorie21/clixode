<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeSort(Builder $query)
    {
        $query->orderBy('id', 'desc');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_m2m_bucket_image', 'image_id', 'bucket_id', 'id', 'id');
    }
}
