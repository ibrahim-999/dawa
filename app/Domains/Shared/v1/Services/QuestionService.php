<?php

namespace App\Domains\Shared\v1\Services;

use App\Models\Question;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class QuestionService
{
    private Model|Builder $questionModel;

    public function __construct()
    {
        $this->questionModel = new Question();

    }

    public function get(): Collection
    {
        try {
            return $this->questionModel->get();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }


    public function with(array $relations): ?QuestionService
    {
        try {
            $this->questionModel = $this->questionModel->with($relations);
            return $this;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
