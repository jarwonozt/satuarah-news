<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ImageCategory;

class Image extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCategory()
    {
        return $this->belongsTo(ImageCategory::class, 'category_id');
    }

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getAvatar($value)
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($value).'&color=305b90&background=e6eaf2';
    }

    public function getImagePathAttribute()
    {
        return '/storage/images/' . $this->image;
    }

    // public function getImageAttribute($value)
    // {
    //     return '/storage/images/' . $value;
    // }
}
