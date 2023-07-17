<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getCreated(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getUrlAttribute()
    {
        return '/tags/'.$this->slug;
    }
}
