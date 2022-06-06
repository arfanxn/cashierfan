<?php

namespace App\Actions;

use App\Helpers\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class StoreProductImageAction
{
    private const FILEPATH = "products/images";

    public static function exec(Product $product, \Illuminate\Http\UploadedFile|null $file = null)
    {
        if ($file === null) return false;

        $fileName = Str::random() . now()->timestamp . "." . $file->extension();

        Storage::putFileAs("public/" . static::FILEPATH, $file, $fileName);

        $product->image = Storage::url(static::FILEPATH . "/" . $fileName);

        return $product->save();
    }
}
