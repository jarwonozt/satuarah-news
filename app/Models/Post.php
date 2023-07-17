<?php

namespace App\Models;

use App\Services\DateServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PostCategory;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['url', 'date', 'date_time', 'images', 'meta_image'];

    protected $dates = ['published_at'];

    public function getCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function addBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getAuthor($id)
    {
        $getUserPoint = Point::where('modul','post')->where('post_id',$id)->get();
                $author = array();
                if(count($getUserPoint) > 0){
                    foreach($getUserPoint as $a=>$b){
                        $author[$a]['code']    = $b->user_type;
                        $author[$a]['type']    = config('app.user_type')[$b->user_type];
                        $getAuthor             = User::where('id', $b->user_id)->first();
                        $author[$a]['name']    = $getAuthor->name;
                        $author[$a]['image']   = '/storage/pictures/users/thumb/'.$getAuthor->image;
                        $author[$a]['avatar']  = isset($getAuthor->image) ? '/storage/pictures/users/thumb/'.$getAuthor->image :'https://ui-avatars.com/api/?name='.urlencode($getAuthor->name).'&color=305b90&background=e6eaf2';
                        $author[$a]['url']     = env('APP_URL').'/author/'.$getAuthor->slug;
                    }
                }
        return $author;
    }

    public function getLinkage()
    {
        return $this->hasMany(PostLinkage::class, 'parent_id');
    }

    public function countLinkage()
    {
        return PostLinkage::where('parent_id', $this->id)->get()->count();
    }

    public function getImagesAttribute()
    {
        return [
            'thumbnail' => '/storage/posts/thumb/' . $this->image,
            'medium' => '/storage/posts/mid/' . $this->image,
            'full' => '/storage/posts/big/' . $this->image,
        ];
    }

    public function getMetaImageAttribute()
    {
        return env('APP_URL').'/storage/posts/big/' . $this->image;
    }

    public function getUrlAttribute()
    {
        $url = url($this->getCategory->slug.'/'.$this->slug.'-'.$this->code);
        return $url;
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->published_at)->isoFormat('dddd, D MMMM Y');
        // return DateServices::dateHome($this->published_at);
    }

    public function getDateTimeAttribute()
    {
        return DateServices::dateTime($this->published_at);
    }
}
