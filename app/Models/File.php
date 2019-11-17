<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = true;
    protected $table = 'file';
    protected $fillable = [];

    protected $casts = [
        'created_at' => 'd.m.Y H:i:s',
        'updated_at' => 'd.m.Y H:i:s',
    ];
}
