<?php

namespace Tests\Feature;

use App\DataTransferObjects\ArticleDTO;
use App\Requests\ArticleRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class ArticleDTOTest extends TestCase
{
    public static function articles(): array
    {
        return[
            ['foo','bar']
        ];
    }

    /**
     * @param string $title
     * @param string $content
     * @return void
     * @dataProvider articles
     */
    public function test_create_from_request(string $title, string $content) : void
    {

        $request = ArticleRequest::createFrom(Request::create('', 'POST', [
            'title' => $title,
            'content' => $content,
        ]));

        $dto = ArticleDTO::createFromRequest($request);

        $this->assertEquals($dto->title,$title);
        $this->assertEquals($dto->content,$content);
    }
}
