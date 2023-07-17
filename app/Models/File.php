<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Services\DateServices;
use App\Models\User;
use App\Models\FileCategory;
use App\Models\FileLinkage;

class File extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['judul', 'url', 'url_file'];

    protected $dates = ['created_at'];

    public function getCategory()
    {
        return $this->belongsTo(FileCategory::class, 'category_id');
    }

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function files()
    {
        return $this->hasMany(FileLinkage::class);
    }

    public function getAvatar($value)
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($value).'&color=305b90&background=e6eaf2';
    }

    public function getJudulAttribute()
    {
        return Str::words($this->title, 11, '...');
    }

    // public function getCreatedAtAttribute()
    // {
    //     return DateServices::dateHome($this->created_at);
    // }

    public function getUrlAttribute()
    {
        $url = env('APP_URL').'/informasi/'.$this->slug;
        return $url;
    }

    public function getUrlFileAttribute()
    {
        $url = env('APP_URL').'/storage/files/'.$this->name;
        return $url;
    }
}
