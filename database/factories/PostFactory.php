<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    $sentence = $faker->sentence;
    return [
 	    'title'             => $sentence,
        'body'              => $sentence,
        'image'             => UploadedFile::fake()->image('image.jpg'),
        'slug'              => str_slug($faker->word),
        'later_publish'     => 'yes',
        'publish_date'     	=> date('Y-m-d'),
        'publish_time'     	=> date('h:i:s'),
        'status'            => 'approved',
        'user_id'			=> function () { return factory('App\Models\User')->create()->id; }
    ];
});
