<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory {

    const TASKS_WITH_DESCRIPTION_PERCENTAGE = 0.45;
    const EDITED_TASK_PERCENTAGE = 0.4;
    
    const VALID_TASK_STATES = [
        'created',
        'member_assigned',
        'completed'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->optional(TaskFactory::TASKS_WITH_DESCRIPTION_PERCENTAGE)->paragraph,
            'creation_date' => $this->faker->dateTimeThisYear('-5 month'),
            'edit_date' => function ($attributes) {
                return $this->faker->optional(TaskFactory::EDITED_TASK_PERCENTAGE)->dateTimeBetween($attributes['creation_date'], 'now');
            },
            'state' => $this->faker->randomElement(TaskFactory::VALID_TASK_STATES)
        ];
    }

    public function withPosition() {
        return $this->sequence(
            fn ($sequence) => ['position' => $sequence->index + 1]
        );
    }

    protected $model = Task::class;
}
