<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskComment>
 */
class TaskCommentFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'content' => $this->faker->paragraph,
            'creation_date' => $this->faker->dateTimeThisYear('-5 month'),
            'edit_date' => function ($attributes) {
                return $this->faker->optional(ThreadFactory::EDITED_THREAD_PERCENTAGE)->dateTimeBetween($attributes['creation_date'], 'now');
            },
        ];
    }

    public function withAuthors(Collection $authors) {
        return $this->sequence(
            fn ($sequence) => ['author_id' => $authors->random()]
        );
    }
}
