<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            // creazione istanza 
            $newPost = new Post();
            // valorizzazione proprietà
            $newPost->title = $faker->sentence(8);
            $newPost->slug = Str::slug($newPost->title);
            $newPost->subtitle = $faker->sentence(6);
            $newPost->text = $faker->text(5000);
            $newPost->author = $faker->name;
            $newPost->img_path = $faker->imageUrl(640, 480, 'nature');
            $newPost->publication_date = $faker->dateTime();
            // salvataggio
            $newPost->save();
        }
    }
}
