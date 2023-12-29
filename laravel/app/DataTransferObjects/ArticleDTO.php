<?php

namespace App\DataTransferObjects;

use App\Requests\ArticleRequest;

class ArticleDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
    )
    {
    }

    public static function createFromRequest(ArticleRequest $request): ArticleDTO
    {
        return new self(
            title: $request->title,
            content: $request->content,
        );
    }
}
