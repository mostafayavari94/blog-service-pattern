<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ArticleDTO;
use App\Requests\ArticleRequest;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function index(ArticleService $service)
    {
        $data = [
            'articles' => $service->getAll(),
        ];
        return view('article.index', compact('data'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(ArticleRequest $request, ArticleService $service)
    {
        $service->create(ArticleDTO::createFromRequest($request));
        return redirect(route('article.index'))->with('message', __('Article created successfully.'));
    }


    public function edit(int $id, ArticleService $service)
    {
        $article = $service->getById($id);
        $data = [
            'article' => $article
        ];
        return view('article.edit', compact('data'));
    }

    public function update(int $id, ArticleRequest $request, ArticleService $service)
    {
        $service->update($id, ArticleDTO::createFromRequest($request));
        return redirect(route('article.index'))->with('message', __('Article updated successfully.'));

    }

    public function destroy(int $id, ArticleService $service)
    {
        if (Auth::user()->hasRole('admin')) {
            $service->delete($id);
            return redirect(route('article.index'))->with('message', __('Article deleted successfully.'));
        } else {
            return redirect(route('article.index'))->with('message', __('access denied'));
        }

    }

    function publish(int $id, ArticleService $service)
    {

        if (Auth::user()->hasRole('admin')) {
            $service->publish($id);
            return redirect(route('article.index'))->with('message', __('Article published successfully.'));
        } else {
            return redirect(route('article.index'))->with('message', __('access denied'));
        }
    }

    function draft(int $id, ArticleService $service)
    {
        if (Auth::user()->hasRole('admin')) {
            $service->draft($id);
            return redirect(route('article.index'))->with('message', __('Article drafted successfully.'));
        } else {
            return redirect(route('article.index'))->with('message', __('access denied'));
        }
    }
}
