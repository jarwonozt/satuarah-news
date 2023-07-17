<?php

namespace App\Models;

use App\Services\DateServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VideoCategory;
use App\Models\User;
use Carbon\Carbon;

class Video extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['date', 'image'];

    protected $dates = ['published_at'];


    public function addBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getCategory()
    {
        return $this->belongsTo(VideoCategory::class, 'category_id');
    }

    public function getAuthor($id)
    {
        $getUserPoint = Point::where('modul','video')->where('post_id',$id)->get();
                $author = array();
                if(count($getUserPoint) > 0){
                    foreach($getUserPoint as $a=>$b){
                        $author[$a]['type_code']    = $b->user_type;
                        $author[$a]['type']         = config('app.user_type')[$b->user_type];
                        $getAuthor                  = User::where('id', $b->user_id)->first();
                        $author[$a]['name']         = $getAuthor->name;
                        $author[$a]['image']        = 'https://storage.nu.or.id/storage/authors/1_1/thumb/'.$getAuthor->image;
                        $author[$a]['avatar']       = 'https://ui-avatars.com/api/?name='.urlencode($getAuthor->name).'&color=305b90&background=e6eaf2';
                        $author[$a]['id']           = $b->user_id;
                    }
                }
        return $author;
    }

    public function getLinkage()
    {
        return $this->hasMany(VideoLinkage::class, 'parent_id');
    }

    public function getDateAttribute()
    {
        // return DateServices::dateHome($this->published_at);
        return Carbon::parse($this->published_at)->isoFormat('dddd, D MMMM Y');
    }

    public function getImageAttribute()
    {
        $data = $this->youtube_id;
        return [
            'thumbnail' => "https://img.youtube.com/vi/$data/maxresdefault.jpg",
            'medium' => "https://img.youtube.com/vi/$data/maxresdefault.jpg",
            'full' => "https://img.youtube.com/vi/$data/maxresdefault.jpg",
        ];
    }
    public function getUrlAttribute()
    {
        $url = url('/video/'.$this->slug);
        return $url;
    }
}
