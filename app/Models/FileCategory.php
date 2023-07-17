<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\User;

class FileCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = ['created_at'];

    public function getParent()
    {
        return $this->belongsTo(File::class, 'parent_id');
    }

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getFiles()
    {
        return $this->hasMany(File::class, 'category_id');
    }
}
