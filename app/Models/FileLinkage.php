<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class FileLinkage extends Model
{
    use HasFactory;
    protected $table = 'file_linkages';
    protected $appends = ['url_file'];
    public $timestamps = false;


    public function getFile(){
        return $this->belongsTo(File::class, 'file_id');
    }

    public function getUrlFileAttribute()
    {
        $url = env('APP_URL').'/storage/files/'.$this->name;
        return $url;
    }
}
