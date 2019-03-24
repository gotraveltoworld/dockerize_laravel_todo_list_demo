<?php

use Faker\Generator as Faker;

$factory->define(App\TodoList::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->content,
        'attachment' => $faker->attachment,
        'attachment_ori_name' => $faker->attachmentOriName,
        'created_at' => gmdate('Y-m-d H:i:s'),
        'updated_at' => gmdate('Y-m-d H:i:s'),
        'deleted_at' => gmdate('Y-m-d H:i:s'),
        'id' => function () {
            return factory(App\TodoList::class)->create()->id;
        },
    ];
});
