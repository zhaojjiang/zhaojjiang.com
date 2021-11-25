<?php

namespace App\Http\Controllers;

use App\Enums\InfoLevel;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $contents = Content::query()->get();
        return view('content.index', compact('contents'));
    }

    public function show(Content $content)
    {
        return view('content.show', compact('content'));
    }

    public function create()
    {
        return view('content.create')->with('is_edit', false);
    }

    public function store()
    {
        $data = $this->request->only(['title', 'content_md', 'content_html']);
        $validator = Validator::make($data, [
            'title' => ['required'],
            'content_md' => ['required_without:content_html'],
            'content_html' => ['required_without:content_md'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with(InfoLevel::ERROR, $validator->messages()->first());
        }

        $content = Content::query()->create($data);
        return redirect()->route('content.show', $content);
    }

    public function edit(Content $content)
    {
        return view('content.create', compact('content'))->with('is_edit', true);
    }

    public function update(Content $content)
    {
        $data = $this->request->only(['title', 'content_md', 'content_html']);
        $validator = Validator::make($data, [
            'title' => ['required'],
            'content_md' => ['required_without:content_html'],
            'content_html' => ['required_without:content_md'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with(InfoLevel::ERROR, $validator->messages()->first());
        }

        $content->update($data);
        return redirect()->route('content.show', $content);
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('content.index');
    }
}
