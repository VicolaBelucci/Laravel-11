<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'related_id'
    ];

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    
    }

    public function relationCategory()
    {

        return $this->belongsTo(Category::class, 'related_id');

    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id');
    }


}
