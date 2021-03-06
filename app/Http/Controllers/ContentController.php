<?php

namespace App\Http\Controllers;

use App\Enums\InfoLevel;
use App\Enums\Visibility;
use App\Models\Content;
use App\Models\ContentTag;
use App\Models\Tag;
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
        $contents = Content::query()->scopes(['type' => [Content::TYPE_POST]])->latest()->paginate(12);
        return view('content.index', compact('contents'));
    }

    public function show($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->with('tags')->findOrFail($content);
        return view('content.show', compact('content'));
    }

    public function create()
    {
        $tags = Tag::query()->pluck('name', 'id')->toArray();
        return view('content.create', compact('tags'))->with('is_edit', false);
    }

    public function store()
    {
        $data = $this->request->only(['title', 'content_md', 'content_html', 'visibility', 'tags']);
        $validator = Validator::make($data, [
            'title' => ['required'],
            'content_md' => ['required_without:content_html'],
            'content_html' => ['required_without:content_md'],
            'visibility' => ['required'],
            'tags' => ['required', 'max:5'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with(InfoLevel::ERROR, $validator->messages()->first());
        }

        $data['type'] = Content::TYPE_POST;
        $data['user_id'] = Auth::id();
        $content = Content::query()->create($data);
        foreach ($data['tags'] as $tag_id) {
            ContentTag::query()->create([
                'content_id' => $content->id,
                'tag_id' => $tag_id,
            ]);
        }
        return redirect()->route('content.show', $content);
    }

    public function edit($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->findOrFail($content);
        $tag_ids = ContentTag::query()->where('content_id', $content->id)->pluck('tag_id')->toArray();
        $tags = Tag::query()->pluck('name', 'id')->toArray();
        return view('content.create', compact('content', 'tag_ids', 'tags'))->with('is_edit', true);
    }

    public function update($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->findOrFail($content);
        $data = $this->request->only(['title', 'content_md', 'content_html', 'visibility', 'tags']);
        $validator = Validator::make($data, [
            'title' => ['required'],
            'content_md' => ['required_without:content_html'],
            'content_html' => ['required_without:content_md'],
            'visibility' => ['required'],
            'tags' => ['required', 'max:5'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->with(InfoLevel::ERROR, $validator->messages()->first());
        }

        $content->update($data);
        ContentTag::query()->where('content_id', $content->id)->delete();
        foreach ($data['tags'] as $tag_id) {
            ContentTag::query()->create([
                'content_id' => $content->id,
                'tag_id' => $tag_id,
            ]);
        }
        return redirect()->route('content.show', $content);
    }

    public function destroy($content)
    {
        $content = Content::query()->scopes(['type' => [Content::TYPE_POST]])->findOrFail($content);
        $content->delete();
        ContentTag::query()->where('content_id', $content->id)->delete();
        return redirect()->route('content.index');
    }
}
