<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class PhotoLinkage extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getParent()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }

    public function getImagePathAttribute()
    {
        return '/storage/photos/linkages/' . $this->image;
    }

}
