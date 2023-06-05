<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Product\v1\Services\BrandService;
use App\Domains\Shared\v1\Services\CityService;
use App\Domains\Shared\v1\Services\QuestionService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Products\BrandResource;
use App\Http\Resources\Shared\CityResource;
use App\Http\Resources\Shared\QuestionResource;
use Illuminate\Http\Request;


class QuestionController extends ApiController
{
    private QuestionService $questionService;

    public function __construct(
        QuestionService $questionService,
    )
    {
        $this->questionService = $questionService;
    }

    public function index(Request $request)
    {   
        $questions =QuestionResource::collection($this->questionService->with(['translation','answer.translation'])->get());
        return $this->successListMessage($questions);
    }
}
