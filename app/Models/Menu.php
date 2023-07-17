<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at'];

    // public function getCategory()
    // {
    //     return $this->belongsTo(MenuCategory::class, 'category_id');
    // }

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getParent($parent_id){
        $data = Menu::where('id', $parent_id)->first('name');
        return $data->name;
    }

    public function getAvatar($value)
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($value).'&color=305b90&background=e6eaf2';
    }
}
