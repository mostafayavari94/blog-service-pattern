<?php

namespace App\Services;

use App\Http\Requests\ArticleCreateRequest;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function __construct(private readonly ArticleRepository $repository)
    {

    }

    function create(ArticleCreateRequest $request): Article
    {
       return $this->repository->create($request->title, $request->content, Auth::user());
    }


}
