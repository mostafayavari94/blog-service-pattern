<?php

namespace Tests\Feature;

use App\DataTransferObjects\ArticleDTO;
use App\Models\Article;
use App\Models\User;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ArticleServiceTest extends TestCase
{

    use RefreshDatabase;

    public static function articles(): array
    {
        return [
            ['foo', 'bar']
        ];
    }

    /**
     * @param string $title
     * @param string $content
     * @return void
     * @dataProvider articles
     */
    public function test_article_service_create(string $title, string $content): void
    {
        $dto = new ArticleDTO(
            title: $title,
            content: $content
        );

        $user = User::factory()->create();
        $this->actingAs($user);

        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("create")
            ->once()
            ->with($dto->title, $dto->content, $user);

        $service = new ArticleService($repository);

        $result = $service->create($dto);
        $this->assertInstanceOf(Article::class, $result);

    }


    /**
     * @param string $title
     * @param string $content
     * @return void
     * @dataProvider articles
     */
    public function test_article_service_update(string $title, string $content): void
    {
        $dto = new ArticleDTO(
            title: $title,
            content: $content
        );

        $article = Article::factory()->create();

        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("update")
            ->once()
            ->with($article, $dto->title, $dto->content);

        $repository->shouldReceive("getById")
            ->once()
            ->with($article->id)
            ->andReturn($article);


        $service = new ArticleService($repository);
        $result = $service->update($article->id,$dto);

        $this->assertInstanceOf(Article::class, $result);

    }

    /**
     * @return void
     */
    public function test_article_service_get_all(): void
    {

        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("getAll")
            ->once();

        $service = new ArticleService($repository);
        $result = $service->getAll();
        $this->assertInstanceOf(Collection::class,$result);


    }

    /**
     * @return void
     */
    public function test_article_service_get_by_id(): void
    {

        $article = Article::factory()->create();
        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("getById")
            ->with($article->id)
            ->once();

        $service = new ArticleService($repository);
        $result = $service->getById($article->id);
        $this->assertInstanceOf(Article::class,$result);

    }

    /**
     * @return void
     */
    public function test_article_service_delete(): void
    {

        $article = Article::factory()->create();

        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("delete")
            ->with($article->id)
            ->once();

        $service = new ArticleService($repository);
        $service->delete($article->id);

    }

    /**
     * @return void
     */
    public function test_article_service_publish(): void
    {

        $article = Article::factory()->create();

        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("publish")
            ->with($article->id)
            ->once();

        $service = new ArticleService($repository);
        $result = $service->publish($article->id);
        $this->assertInstanceOf(Article::class,$result);

    }

    /**
     * @return void
     */
    public function test_article_service_draft(): void
    {

        $article = Article::factory()->create();

        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("draft")
            ->with($article->id)
            ->once();

        $service = new ArticleService($repository);
        $result = $service->draft($article->id);
        $this->assertInstanceOf(Article::class,$result);

    }
}
