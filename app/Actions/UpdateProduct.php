<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Product;

class UpdateProduct
{
    use AsAction;

    public function handle($data)
    {
        if ($data['hasFile'] instanceof \Illuminate\Http\UploadedFile) {
            $imageUrl_01 = $data['image_01']->store('public/images');
            $imageUrl_01 = str_replace('public', 'storage', $imageUrl_01);
        } else {
            if(is_string($data['image_01'])){ $imageUrl_01 = $data['image_01']; }
        }
        
        $response = Product::where('id', $data['id'])->update([
            'productName' => $data['productName'],
            'shortDescription' => $data['shortDescription'],
            'company' => $data['company'],
            'brand' => $data['brand'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'address' => $data['address'],
            'website' => $data['website'],
            'email' => $data['email'],
            'priority' => $data['priority'],
            'remember' => $data['remember'],
            'image_01' => $imageUrl_01,
            'image_02' => null,
            'image_03' => null,
            'image_04' => null,
            'image_05' => null
        ]);
        return $response;
    }
}
