<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Product\v1\Services\BrandService;
use App\Domains\Shared\v1\Services\CityService;
use App\Domains\Shared\v1\Services\CommentsService;
use App\Domains\Shared\v1\Services\NotificationService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Products\BrandResource;
use App\Http\Resources\Shared\CityResource;
use App\Http\Resources\Shared\CommentResource;
use App\Http\Resources\Shared\NotificationResource;
use Illuminate\Http\Request;


class CommentController extends ApiController
{
    private CommentsService $commentsService;

    public function __construct(
        CommentsService $commentsService,
    )
    {
        $this->commentsService = $commentsService;
    }

    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 10 ;

        $comments = $this->commentsService->paginate_simple($page_size);
        // dd($result);
        $data = CommentResource::collection($comments)->resource->toArray();

        $data_array=['comments' => $data['data']];

        unset($data['data']);

        return $this->successShowPaginationResponse($data_array, $data, 'comments');
    }

    public function show($reason)
    {
        $comment = $this->commentsService->find('reason', $reason);

        if (!$comment) {
            return $this->failResourceNotFoundMessage('comment_item');
        }

        $data = CommentResource::make($comment);

        return $this->successShowDataResponse($data, 'comment_item');
    }
}