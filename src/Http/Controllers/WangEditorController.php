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
        $files = $request->file();
        $res = ['errno' => 1, 'errmsg' => '上传图片错误'];
        if ( count($files) > 0 ) {
            $data = [];
            foreach ( $files as $key => $file ) {
                $ext = strtolower($file->extension());
                $exts = ['jpg', 'png', 'gif', 'jpeg'];
                if ( !in_array($ext, $exts) ) {
                    $res = ['errno' => 1, 'errmsg' => '请上传正确的图片类型,支持jpg,png,gif,jpeg'];
                    return response()->json($res);
                }
                $filename = time() . random_int(1, 1000) . random_int(1, 1000) . '.' . $ext;
                $filepath = 'uploads/images/' . date('Ymd') . '/';
                if ( !file_exists(public_path($filepath)) ) {
                    @mkdir(public_path($filepath));
                }
                $savepath = env('APP_URL') . '/' . $filepath . $filename;
                if ( $file->move($filepath, $filename) ) {
                    $data[] = array(
                        "url" => $savepath,
                        'alt' => '',
                        'href' => ''
                    );
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
        $filepath = public_path('uploads/video/' . date('Ymd') . '/');
        if ( !file_exists($filepath) ) {
            @mkdir($filepath);
        }
        $savepath = env('APP_URL') . '/uploads/video/' . date('Ymd') . '/' . $filename;
        $file->move($filepath, $filename);
        return response()->json([
            'errno' => 0,
            'data' => [
                "url" => $savepath
            ]
        ]);
    }
}
