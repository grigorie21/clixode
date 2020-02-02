<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BucketFile extends Model
{
    public $timestamps = true;
    protected $table = 'bucket_file';
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

    public function files() {
        return $this->belongsToMany(File::class, 'file_m2m_bucket', 'bucket_id', 'file_id', 'id', 'id');
    }
}
