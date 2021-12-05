<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $tags = Tag::query()->withCount('contents')->get();
        return view('tag.index', compact('tags'));
    }

    public function show($tag)
    {
        $tag = Tag::query()->with('contents')->findOrFail($tag);
        $contents = $tag->contents;
        return view('content.index', compact('contents', 'tag'));
    }
}
