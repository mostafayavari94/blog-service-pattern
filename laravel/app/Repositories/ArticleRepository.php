<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class ArticleRepository
{

    public static function create(string $title, string $content, User $author): Article
    {
        return Article::create([
            'title' => $title,
            'content' => $content,
            'author_id' => $author->id,
        ]);
    }

    public static function update(Article $article, string $title, string $content, User $author): Article
    {
        $article->title = $title;
        $article->content = $content;
        $article->Author()->associate($author);
        $article->save();

        return $article;
    }

    public static function getAll(): Collection
    {
        return Article::all();
    }

    public static function find($id): Collection
    {
        return Article::find($id);
    }
}
