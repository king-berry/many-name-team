<?php
namespace App\Traits;

use App\Models\ProductModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    protected $folderName='storage';
    //Xử lý upload 1 ảnh 
    public function handleUploadImage($request, $fieldName, $folderName)
    {
        //Kiểm tra có request fieldName có tồn tại không
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            //Tạo tên ảnh mới
            $imageName = Str::random(10) . "_" . $image->getClientOriginalName();

            //Upload ảnh vào store với path public/' . $folderName, $imageName
            $path = $request->file($fieldName)->storeAs('public/' . $folderName, $imageName);

            $dataPath = Storage::url($path);

            return $dataPath;
        }
        return null;
    }

    // Xử lý upload nhiều ảnh
    public function handleUploadImageProduct($request, $fieldName, $folderName)
    {
        $dataPath = [];
        if ($request->hasFile($fieldName)) {
            foreach ($request->$fieldName as $item) {
                $imageName = Str::random(10) . "_" . $item->getClientOriginalName();
                $path = $item->storeAs('public/' . $folderName, $imageName);

                $dataPath[$imageName] = Storage::url($path);
            }
        }
        return $dataPath;
    }
}