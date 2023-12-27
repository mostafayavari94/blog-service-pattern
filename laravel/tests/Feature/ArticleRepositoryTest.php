<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;


    public static function article(): array
    {
        return[

            ["foo","bar"],
            ["foo1","bar1"],
        ];
    }

    /**
     * article repository test
     * @return void
     */
    public function test_repository_create_article(): void
    {
        $fake_article = Article::factory()->make();
        $user = $fake_article->Author;

        $created_article = ArticleRepository::create($fake_article->title, $fake_article->content, $user);

        $this->assertInstanceOf(Article::class, $created_article);

        $this->assertModelExists($created_article);

        $this->assertDatabaseHas(Article::class, [
            'title' => $fake_article->title,
            'content' => $fake_article->content,
            'publication_status' => false,
            'author_id' => $user->id,
        ]);

    }

    /**
     * @param string $title
     * @param string $content
     * @return void
     * @dataProvider article
     */
    public function test_repository_update_article(string $title, string $content): void
    {
        $fake_article = Article::factory()->create();

        $user = User::factory()->create();


        $updated_article = ArticleRepository::update($fake_article, $title, $content, $user);

        $this->assertInstanceOf(Article::class, $updated_article);

        $this->assertModelExists($updated_article);

        $this->assertDatabaseHas(Article::class, [
            'title' => $title,
            'content' => $content,
            'author_id' => $user->id,
        ]);

    }


    public static function number_list(): array
    {
        return[[4],[2],[5]];
    }

    /**
     * @param $qty
     * @return void
     * @dataProvider number_list
     */
    public function test_repository_get_all_articles($qty) : void
    {
        $articles = Article::factory($qty)->create();

        $all_articles = ArticleRepository::getAll();

        assertEquals($qty,$articles->count());

        self::assertTrue($all_articles->contains($articles->first()->id));
    }


}
