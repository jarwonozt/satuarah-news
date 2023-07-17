<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getTypeUser($id, $user_id){
        $getUserPoint = Point::where('modul','post')->where('post_id',$id)->where('user_id', $user_id)->get();
                $user = array();
                if(count($getUserPoint) > 0){
                    foreach($getUserPoint as $a=>$b){
                        $user[$a]['type'] = config('app.user_type')[$b->user_type];
                    }
                }
        return $user;
    }

    public function getCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function getPost()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
