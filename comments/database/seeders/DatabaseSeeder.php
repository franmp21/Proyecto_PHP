<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10) //Se crean 10 usuarios
        ->hasComments(3) //Tiene 3 comentarios cada usuario
        ->create();
        
        $comments = \App\Models\Comment::get();
        //Por cada comentario se crea de 1 a 3 respuestas y cada respuesta pertenecerá a un comentario 
        //y a una persona aleatoria
        foreach($comments as $comment){
            \App\Models\Reply::factory(rand(1, 3))->create([
                'comment_id' => $comment->id,
                'user_id' => rand(1, 10)
            ]);
        }
    }
}
