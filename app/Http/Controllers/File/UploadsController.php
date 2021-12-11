<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadsController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    public function uploads()
    {
        if ($this->request->input('from') === 'editor.md') {
            $file = $this->request->file('editormd-image-file');
        } else {
            return response()->json([
                'success' => 0,
                'message' => '非法操作',
            ]);
        }

        if (!$file || !$file->isValid()) {
            return response()->json([
                'success' => 0,
                'message' => '未检测到有效文件',
            ]);
        }

        $user = Auth::user();
        $ts = microtime(true) * 1000;
        $folder = "uploads/image/editor.md/" . date('Ym') . "/" . date('d');
        try {
            $file = $file->move(public_path($folder), "{$user->id}_{$ts}." . $file->getClientOriginalExtension());
        } catch (Exception $fileException) {
            return response()->json([
                'success' => 0,
                'message' => $fileException->getMessage(),
            ]);
        }

        return response()->json([
            'success' => 1,
            'message' => '上传成功',
            'url' => "/$folder/{$file->getFilename()}",
        ]);
    }
}
