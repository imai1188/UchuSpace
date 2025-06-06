<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function generateOilPaintTexture()
    {
        // 元の背景画像を使う（すでにある evening.webp）
        $imagePath = public_path('images/evening.webp');

        // Intervention Imageで画像を加工
        $image = Image::make($imagePath);

        // 油絵風のエフェクト（ぼかし+シャープ）
        $image->blur(15);  // ぼかしを入れる
        $image->sharpen(20); // シャープを強くして筆のタッチを強調

        // 加工後の画像を保存
        $outputPath = public_path('images/oil_paint_texture.webp');
        $image->save($outputPath);

        return response()->json(['message' => '画像が生成されました！']);
    }
}
