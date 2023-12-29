<?php

namespace Tests\Feature;

use App\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ArticleRequestTest extends TestCase
{
    public static function valid_values(): array
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
     * @dataProvider valid_values
     */
    public function test_valid_article_request(string $title, string $content): void
    {
        $requestData = [
            'title' => $title,
            'content' => $content,
        ];

        $request = new ArticleRequest($requestData);

        $validator = Validator::make($requestData, $request->rules());

        $this->assertTrue($validator->passes());

        $this->assertEquals($requestData['title'], $request->title);
        $this->assertEquals($requestData['content'], $request->content);
    }


    public static function invalid_values(): array
    {
        return [
            ['', 'bar'],
            ['john', ''],
            ['more_than_100_character_more_than_100_character_more_than_100_character_more_than_100_character_more_than_100_character', 'second article'],
        ];
    }

    /**
     * @param string $title
     * @param string $content
     * @dataProvider invalid_values
     */
    public function test_invalid_article_request(string $title, string $content): void
    {
        $requestData = [
            'title' => $title,
            'content' => $content,
        ];

        $request = new ArticleRequest($requestData);

        $validator = Validator::make($requestData, $request->rules());

        $this->assertFalse($validator->passes());

    }

}
