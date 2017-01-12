<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * 上传文件
 * Class UploadController
 * @package App\Http\Controllers
 */
class UploadController extends Controller
{
    /**
     * 接受文件
     * @param Request $request
     */
    public function index(Request $request)
    {
        $path = $request->file('editor')->store('test/wangEditor');
        /**
         * 判断是否是本地文件
         * oss 上传方式不返回文件名
         */
        if (config("filesystems.default") == "oss") {
            return config("admin.upload.host") . "test/wangEditor/" . $request->file('editor')->hashName();
        } else {
            return url($path);
        }
    }

    /**
     * 上传文件
     */
    public function upload()
    {
        return view("form");
    }

}
