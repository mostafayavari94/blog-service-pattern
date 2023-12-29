<?php

namespace App\Repositories;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class ArticleRepository
{

    public function create(string $title, string $content, User $author): Article
    {
        $article = Article::create([
            'title' => $title,
            'content' => $content,
        ]);
        $article->Author()->associate($author);
        $article->save();
        return $article;
    }

    public function update(Article $article, string $title, string $content): Article
    {
        $article->title = $title;
        $article->content = $content;
        $article->save();

        return $article;
    }

    public function getAll(): Collection
    {
        return Article::all();
    }

    public function getById(int $id): Article
    {
        return Article::findOrFail($id);
    }

    public function delete(int $id)
    {
        $article = $this->getById($id);
        $article->delete();
        return true;
    }

    public function publish(int $id): Article
    {
        $article = $this->getById($id);
        $article->publication_status = ArticleStatus::Publish;
        $article->publication_date = now();
        $article->save();
        return $article;
    }

    public function draft(int $id): Article
    {
        $article = $this->getById($id);
        $article->publication_status = ArticleStatus::Draft;
        $article->publication_date = now();
        $article->save();
        return $article;
    }
}
