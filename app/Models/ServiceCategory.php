<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getParent()
    {
        return ServiceCategory::find($this->parent_id)?->name;
    }

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
