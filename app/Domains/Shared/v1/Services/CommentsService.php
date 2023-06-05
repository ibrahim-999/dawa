<?php

namespace App\Domains\Shared\v1\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class CommentsService 
{
    public function paginate_simple(int $itemsPerPage): Paginator
    {
        try {
            $user = getAuthUser();
            
            return $user->comments()->with('profileComments')->orderBy('created_at', 'desc')->simplePaginate($itemsPerPage);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function find(string $key, string $value): ?Model
    {
        try {
            $user = getAuthUser();
            
            $comment = $user->comments()->with('profileComments')->where($key, $value)->orderBy('created_at', 'desc')->first();

            return $comment; 
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }

    public function delete(Model $item): bool
    {
        try {
            return $item->delete();
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}