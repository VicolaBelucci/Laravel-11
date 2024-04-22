<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Domésticas', 'description' => 'Tarefas domésticas gerais'],
            ['title' => 'Trabalho', 'description' => 'Tarefas relacionadas ao trabalho'],
            ['title' => 'Lazer', 'description' => 'Atividades de lazer e entretenimento'],
            ['title' => 'Saúde', 'description' => 'Atividades relacionadas à saúde e bem-estar'],
            ['title' => 'Estudos', 'description' => 'Tarefas relacionadas a estudos e aprendizado']
        ];

        foreach ($categories as $categoryData) {
            $category = Category::factory()->create([
                'title' => $categoryData['title'],
                'description' => $categoryData['description'],
                'user_id' => 1,
                'related_id' => null
            ]);

            // Criar 4 tarefas para cada categoria
            for ($i = 0; $i < 4; $i++) {
                Task::factory()->create([
                    'category_id' => $category->id,  // Associando a task à categoria recém criada
                    'user_id' => 1,  // Mesmo usuário id para simplicidade
                ]);
            }
        }
    }
}
