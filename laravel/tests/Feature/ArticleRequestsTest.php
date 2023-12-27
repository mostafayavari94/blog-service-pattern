<?php

namespace Tests\Feature;

use App\Http\Requests\ArticleCreateRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ArticleRequestsTest extends TestCase
{
    public static function articles()
    {
        return [
            ['foo', 'bar'],
            ['john', 'an article'],
            ['mick', 'second article'],
        ];
    }

    /**
     * @param string $title
     * @param string $content
     * @dataProvider articles
     */
    public function test_create_article_request($title, $content): void
    {
        $requestData = [
            'title' => $title,
            'content' => $content,
        ];

        $request = new ArticleCreateRequest($requestData);

        $validator = Validator::make($requestData, $request->rules());

        $this->assertTrue($validator->passes());

        $this->assertEquals($requestData['title'], $request->title);
        $this->assertEquals($requestData['content'], $request->content);
    }
}
