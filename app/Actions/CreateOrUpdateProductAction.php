<?php

namespace App\Actions;

use App\Helpers\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class CreateOrUpdateProductAction
{
    private const FILEPATH = "products/images";

    public static function exec(
        int|null $id = null,
        string $barcode,
        string $name,
        string|null  $description = null,
        \Illuminate\Http\UploadedFile|null $image,
        int|float $tax_percentage,
        int|float $profit_percentage,
        float $gross_price,
        int $stock,
    ) {
        $product = new Product;
        if ($id) // if the "id" argument is provided do the query 
            $product = $product->query()->where("id", $id)->first() ?? $product;

        $tax = ($gross_price / 100) * $tax_percentage ??  0;
        $profit = ($gross_price / 100) * $profit_percentage ??  0;
        $netPrice = $gross_price + $tax + $profit;

        $product->fill([
            "barcode" => strtoupper($barcode),
            "name" => ucwords($name),
            "description" => $description,
            // update the product image at bottom
            "tax_percentage" => $tax_percentage,
            "profit_percentage" => $profit_percentage,
            "gross_price" => $gross_price,
            "stock" => $stock,
            "tax" => $tax,
            "profit" => $profit,
            "net_price" => $netPrice,
        ]);

        if ($image instanceof \Illuminate\Http\UploadedFile) {
            $fileName = Str::random() . now()->timestamp . "." . $image->extension();
            Storage::putFileAs("public/" . static::FILEPATH, $image, $fileName);
            $product->image = Storage::url(static::FILEPATH . "/" . $fileName);
        }

        return $product->save();
    }
}
