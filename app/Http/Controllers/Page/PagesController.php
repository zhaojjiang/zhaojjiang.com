<?php

namespace App\Http\Controllers\Page;

use App\Enums\InfoLevel;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function welcome()
    {
        return view('pages.welcome');
    }

    public function home()
    {
        return (new ContentController(request()))->index();
    }

    public function about()
    {
        $page = Content::query()->scopes(['type' => [Content::TYPE_PAGE]])
            ->where('name', 'about')
            ->firstOrFail();
        return view('pages.show', compact('page'));
    }

    public function show($page)
    {
        $page = Content::query()->scopes(['type' => [Content::TYPE_PAGE]])
            ->where('name', $page)
            ->firstOrFail();
        return view('pages.show', compact('page'));
    }

    public function edit($page)
    {
        $page = Content::query()->scopes(['type' => [Content::TYPE_PAGE]])
            ->where('name', $page)
            ->firstOrFail();
        $is_edit = true;
        return view('pages.create', compact('is_edit', 'page'));
    }

    public function update($page)
    {
        $page = Content::query()->scopes(['type' => [Content::TYPE_PAGE]])
            ->where('name', $page)
            ->firstOrFail();
        $data = $this->request->only(['title', 'content_md', 'content_html']);
        $validator = Validator::make($data, [
            'title' => ['required'],
            'content_md' => ['required_without:content_html'],
            'content_html' => ['required_without:content_md'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with(InfoLevel::ERROR, $validator->messages()->first());
        }

        $page->update($data);
        return redirect()->route('page.show', $page->name);
    }
}
