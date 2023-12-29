<?php

namespace App\Services;

use App\DataTransferObjects\ArticleDTO;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function __construct(private readonly ArticleRepository $repository)
    {

    }

    public function create(ArticleDTO $dto): Article
    {
        return $this->repository->create($dto->title, $dto->content, Auth::user());
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    function update(int $id, ArticleDTO $dto): Article
    {
        return $this->repository->update($this->getById($id), $dto->title, $dto->content);
    }

    public function getById(int $id): Article
    {
        return $this->repository->getById($id);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function draft(int $id): Article
    {
        return $this->repository->draft($id);
    }

    function publish(int $id): Article
    {
        return $this->repository->publish($id);

    }


}
