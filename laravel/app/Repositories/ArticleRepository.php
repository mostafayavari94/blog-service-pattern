<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository
{

    function create(string $title, string $content, User $author): Article
    {
        return Article::create([
            'title' => $title,
            'content' => $content,
            'author_id' => $author->id,
        ]);
    }

    function update(Article $article, string $title, string $content, User $author) : Article
    {
        $article->title = $title;
        $article->content = $content;
        $article->Author()->associate($author);
        $article->save();

        return $article;
    }

    function getAll(): Collection
    {
        return Article::all();
    }

    function find($id): Collection
    {
        return Article::find($id);
    }
}
