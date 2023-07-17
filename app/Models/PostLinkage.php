<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PostCategory;

class PostLinkage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;


    public function getParent()
    {
        return PostCategory::find($this->parent_id)->name;
    }

    public function getPost()
    {
        return $this->belongsTo(Post::class, 'child_id', 'id');
    }

    public function getCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id', 'id');
    }
}
