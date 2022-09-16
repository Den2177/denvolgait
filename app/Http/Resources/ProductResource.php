<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = null;
    public function toArray($request)
    {
        $categories = $this->category;
        $productFeatures = $this->features;

        $categories = explode('///', $categories);
        $productFeatures = explode(';', $productFeatures);

        $edittedFeatures = [];

        foreach ($productFeatures as $feature) {
            $key = trim(explode(": ", $feature)[0]);
            $value = explode(":", $feature);

            if (empty($value[1])) {
                $value = '';
            } else {
                $value = trim($value[1]);
            }

            $value = preg_replace("/[A-Z]\[]/", '', $value);
            $edittedFeatures[$key] = $value;
        }

        return [
            'product_id' => $this->id,
            'product_code' => $this->code,
            'language' => $this->language,
            'category' => $categories,
            'list_price' => $this->list_price,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'product_name' => $this->name,
            'seo_name' => $this->seo_name,
            'short_description' => $this->short,
            'status' => $this->status,
            'vendor' => $this->vendor,
            'product_features' => $edittedFeatures,
        ];
    }
}
