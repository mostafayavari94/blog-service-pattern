<?php

namespace Tests\Feature;

use App\Http\Requests\ArticleCreateRequest;
use App\Models\Article;
use App\Models\User;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class ArticleServiceTest extends TestCase
{

    use RefreshDatabase;

    public static function articles()
    {
        return [
            ['foo', 'bar']
        ];
    }

    /**
     * @param $title
     * @param $content
     * @return void
     * @dataProvider articles
     */
    public function test_create_article_service($title, $content): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive("create")->once()->with($title, $content, $user);

        // Your fake input data
        $requestData = [
            'title' => $title,
            'content' => $content,
        ];

        // Create a fake instance of YourRequest
        $formRequest = ArticleCreateRequest::createFrom(Request::create('', 'POST', $requestData));

        $service = new ArticleService($repository);

        $result = $service->create($formRequest);
        self::assertInstanceOf(Article::class, $result);

    }

}
