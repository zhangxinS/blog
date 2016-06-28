<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Services\UploadsManager;
use App\Http\Controllers\Controller;

use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\UploadNewFolderRequest;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    protected $manager;

    /**
     * 构造方法
     * UploadController constructor.
     * @param UploadsManager $manager
     */
    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);

        return view('admin.upload.index',$data);
    }

    /**
     * 创建新目录
     * @param UploadNewFolderRequest $request
     * @return $this
     */
    public function createFolder(UploadNewFolderRequest $request){
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder').'/'.$new_folder;

        $result = $this->manager->createDirectory($folder);

        if ($request === true) {
            return redirect()->back()->withSuccess("Folder '$new_folder' created.");
        }

        $error = $result ? : "An error occurred creating directory.";

        return redirect()->back()->withErrors([$error]);
    }

    /**
     * 删除文件
     * @param Request $request
     * @return $this
     */
    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get('folder').'/'.$del_file;

        $result = $this->manager->deleteFile($path);

        if ($result === true) {
            return redirect()->back()->withSuccess("File '$del_file' deleted");
        }

        $error = $result ? : "An error occurred deleting file.";
        return redirect()->back()->withErrors([$error]);
    }

    /**
     * 删除目录
     * @param Request $request
     * @return $this
     */
    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder = $request->get('folder').'/'.$del_folder;

        $result = $this->manager->deleteDirectory($folder);

        if ($result === true) {
            return redirect()->back()->withSuccess("Folder '$del_folder' deleted");
        }

        $error = $result ? : "An error occurred deleting directory.";
        return redirect()->back()->withErrors([$error]);
    }

    /**
     * 上传文件
     * @param UploadFileRequest $request
     * @return $this
     */
    public function uploadFile(UploadFileRequest $request){
        $file = $_FILES['file'];
        $fileName = $request->get('file_name');
        $fileName = $fileName ?: $file['name'];
        $path = str_finish($request->get('folder'),'/').$fileName;
        $content = File::get($file['tmp_name']);

        $result = $this->manager->saveFile($path,$content);

        if ($result === true) {
            return redirect()->back()->withSuccess("File '$fileName' uploaded.");
        }
        $error = $result ? : "AN error occurred uploading file.";

        return redirect()->back()->withErrors([$error]);
    }
}
