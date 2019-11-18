<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FileM2MBucket extends Model
{
    public $timestamps = false;
    protected $table = 'file_m2m_bucket';
    protected $fillable = ['file_id', 'bucket_id', 'name', 'slug', 'created_at'];

    public function file()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }
}
