<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Authors;
use App\Models\Books;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        //default first user
        $user = new User();
        $user->name ='Admin';
        $user->email ='admin@admin.com';
        $user->password = Hash::make('admin123');
        $user->save();

        //default firsts authors
        $author = new Authors();
        $author->name ='author1';
        $author->birthday ='1988-01-05';
        $author->nationality = 'PYO';
        $author->save();

        $author = new Authors();
        $author->name ='author02';
        $author->birthday ='2025-01-06';
        $author->nationality = 'USA';
        $author->save();

        //default firsts books
        $book = new Books();
        $book->title ='Book1';
        $book->published_date ='1988-01-05';
        $book->isbn = 'bbk0001-002';
        $book->author_id = '1';
        $book->save();

        
        $book = new Books();
        $book->title ='Book2';
        $book->published_date ='2020-01-05';
        $book->isbn = 'bbk0021-002';
        $book->author_id = '2';
        $book->save();

        $book = new Books();
        $book->title ='Book3';
        $book->published_date ='2010-01-05';
        $book->isbn = 'bbk0021-102';
        $book->author_id = '1';
        $book->save();
    }
}
