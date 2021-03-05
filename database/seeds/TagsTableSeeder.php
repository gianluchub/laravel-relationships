<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'PHP',
            'Laravel',
            'Javascript',
            'HTML',
            'CSS'
        ];

        foreach($tags as $tag) {
            // 1: creazione istanza
            $newTag = new Tag();
            // 2: valorizzazione proprietà
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag);
            // 3: salvataggio
            $newTag->save();
        }

    }
}
