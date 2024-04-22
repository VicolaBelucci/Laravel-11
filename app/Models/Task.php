<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'exprationDate',
        'status',
        'user_id',
        'category_id',
        'related_id'
    ];

    public function user()
    {
        
        return $this->belongsTo(User::class, 'user_id');

    }

    public function category()
    {
        
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function relationTask()
    {

        return $this->belongsTo(Task::class, 'related_id');
        
    }
}
