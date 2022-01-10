<?php

namespace PandaOreo\WangEditor\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class WangEditorController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(Admin::view('panda-oreo.wang-editor::index'));
    }

    public function uploadImage(Request $request)
    {
        $files = $request->file('wangpic');
        $res = ['errno' => 1, 'errmsg' => '上传图片错误'];
        if ( $request->hasFile('wangpic') && count($files) > 0 ) {
            $data = [];
            foreach ( $files as $key => $file ) {
                $ext = strtolower($file->extension());
                $exts = ['jpg', 'png', 'gif', 'jpeg'];
                if ( !in_array($ext, $exts) ) {
                    $res = ['errno' => 1, 'errmsg' => '请上传正确的图片类型,支持jpg,png,gif,jpeg'];
                    return response()->json($res);
                }
                $filename = time() . str_random(6) . '.' . $ext;
                $filepath = 'uploads/images/' . date('ymd') . '/';
                if ( !file_exists($filepath) && !mkdir($filepath) && !is_dir($filepath) ) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $filepath));
                }
                $savepath = env('APP_URL') . '/' . $filepath . $filename;
                if ( $file->move($filepath, $filename) ) {
                    $data[$key]['url'] = $savepath;
                    $data[$key]['alt'] = '';
                    $data[$key]['href'] = '';
                }
            }
            $res = ['errno' => 0, 'data' => $data];
        }
        return response()->json($res);
    }

    public function uploadVideo(Request $request)
    {
        $file = $request->file('wangvideo');
        $filename = time() . random_int(6, 6) . '.mp4';
        $filepath = 'uploads/video/' . date('Ymd') . '/';
        if ( !file_exists($filepath) ) {
            @mkdir($filepath);
        }
        $savepath = env('APP_URL') . '/' . $filepath . $filename;
        $file->move($filepath, $filename);
        return response()->json([
            'errno' => 0,
            'data' => [
                "url" => $savepath
            ]
        ]);
    }
}
