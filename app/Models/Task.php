<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'expirationDate',
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

    // protected function status(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $this->translateStatus($value)  
    //     );  
    // }

    public function getStatusAttribute($value)
    {
        $statusTranslations = [
            'pending' => 'Pendente',
            'in_progress' => 'Em Progresso',
            'completed' => 'Concluída'
        ];

        return isset($statusTranslations[$value]) ? $statusTranslations[$value] : $value;
    }

    // Método para traduzir os valores de status
    // protected function translateStatus($status): string
    // {
    //     return match($status) {
    //         'pending' => 'pendente',
    //         'in_progress' => 'em progresso',
    //         'completed' => 'completa',
    //         // default => $status
    //     };
    // }
}
