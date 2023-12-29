<?php

namespace Tests\Feature;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ArticleRepository $repo;

    public static function article(): array
    {
        return [
            ["foo", "bar"],
            ["foo1", "bar1"],
        ];
    }

    public static function number_list(): array
    {
        return [[4], [2], [5]];
    }

    /**
     * article repository test
     * @return void
     */
    public function test_repository_create(): void
    {
        $fake_article = Article::factory()->make();
        $user = $fake_article->Author;

        $created_article = $this->repo->create($fake_article->title, $fake_article->content, $user);

        $this->assertInstanceOf(Article::class, $created_article);

        $this->assertModelExists($created_article);

        $this->assertDatabaseHas(Article::class, [
            'title' => $fake_article->title,
            'content' => $fake_article->content,
            'publication_status' => ArticleStatus::Draft,
            'author_id' => $user->id,
        ]);

    }

    /**
     * @param string $title
     * @param string $content
     * @return void
     * @dataProvider article
     */
    public function test_repository_update(string $title, string $content): void
    {
        $fake_article = Article::factory()->create();

        $user = User::factory()->create();


        $updated_article = $this->repo->update($fake_article, $title, $content);

        $this->assertInstanceOf(Article::class, $updated_article);

        $this->assertModelExists($updated_article);

        $this->assertDatabaseHas(Article::class, [
            'title' => $title,
            'content' => $content,
            'publication_status' => $fake_article->publication_status,
            'author_id' => $fake_article->author_id,
        ]);

    }

    /**
     * @param $qty
     * @return void
     * @dataProvider number_list
     */
    public function test_repository_get_all($qty): void
    {
        $articles = Article::factory($qty)->create();

        $all_articles = $this->repo->getAll();

        assertEquals($qty, $articles->count());

        $this->assertTrue($all_articles->contains($articles->first()->id));
    }

    /**
     * @param $qty
     * @return void
     * @dataProvider number_list
     */
    public function test_repository_get_by_id($qty): void
    {
        Article::factory($qty)->create();

        $article = $this->repo->getById(1);
        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals(1, $article->id);
    }

    /**
     * @return void
     */
    public function test_publish(): void
    {
        $article = Article::factory()->create();
        $article = $this->repo->publish($article->id);
        $this->assertTrue($article->publication_status === ArticleStatus::Publish);
        $this->assertInstanceOf(Article::class, $article);
    }

    /**
     * @return void
     */
    public function test_draft(): void
    {
        $article = Article::factory()->create();
        $article = $this->repo->draft($article->id);
        $this->assertTrue($article->publication_status === ArticleStatus::Draft);
        $this->assertInstanceOf(Article::class, $article);

    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new ArticleRepository();

    }

}
