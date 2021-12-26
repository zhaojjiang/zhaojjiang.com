<?php

namespace App\Http\Controllers;

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
        $tags = Tag::query()->whereHas('contents')->withCount('contents')->get();
        return view('tag.index', compact('tags'));
    }

    public function show($tag)
    {
        $tag = Tag::query()->with('contents')->findOrFail($tag);
        $contents = $tag->contents()->latest()->paginate(12);
        return view('content.index', compact('contents', 'tag'));
    }
}
