<?php

namespace App\Services;

use App\Http\Requests\ArticleCreateRequest;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function __construct(private readonly ArticleRepository $repository)
    {

    }

    function create(ArticleCreateRequest $request)
    {
        $this->repository->create($request->title, $request->context, Auth::user());
    }
}
