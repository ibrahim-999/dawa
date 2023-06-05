<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::factory()->count(10)->create()->each(function ($question){
            Answer::factory()->count(1)->create(['question_id'=>$question->id]);
        });
    }
}
