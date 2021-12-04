<?php

namespace App\Http\Controllers;

use App\Enums\InfoLevel;
use App\Enums\Visibility;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth')->except('index', 'show');
        $this->request = $request;
    }

    public function index()
    {
        $contents = Content::query()->scopes(['type' => [Content::TYPE_POST]])->get();
        return view('content.index', compact('contents'));
    }

    public function show($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->findOrFail($content);
        return view('content.show', compact('content'));
    }

    public function create()
    {
        return view('content.create')->with('is_edit', false);
    }

    public function store()
    {
        $data = $this->request->only(['title', 'content_md', 'content_html', 'visibility']);
        $validator = Validator::make($data, [
            'title' => ['required'],
            'content_md' => ['required_without:content_html'],
            'content_html' => ['required_without:content_md'],
            'visibility' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with(InfoLevel::ERROR, $validator->messages()->first());
        }

        $data['type'] = Content::TYPE_POST;
        $data['visibility'] = Visibility::PUBLIC;
        $data['user_id'] = Auth::id();
        $content = Content::query()->create($data);
        return redirect()->route('content.show', $content);
    }

    public function edit($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->findOrFail($content);
        return view('content.create', compact('content'))->with('is_edit', true);
    }

    public function update($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->findOrFail($content);
        $data = $this->request->only(['title', 'content_md', 'content_html', 'visibility']);
        $validator = Validator::make($data, [
            'title' => ['required'],
            'content_md' => ['required_without:content_html'],
            'content_html' => ['required_without:content_md'],
            'visibility' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with(InfoLevel::ERROR, $validator->messages()->first());
        }

        $content->update($data);
        return redirect()->route('content.show', $content);
    }

    public function destroy($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->findOrFail($content);
        $content->delete();
        return redirect()->route('content.index');
    }
}
