<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = true;
    protected $table = 'file';
    protected $fillable = ['source_name', 'sha256', 'size'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function bucket() {
        return $this->belongsToMany(BucketFile::class, 'file_m2m_bucket', 'file_id', 'bucket_id', 'id', 'id')
            ->withPivot('name', 'slug', 'created_at');
    }
}
