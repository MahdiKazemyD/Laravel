<?php

namespace App\Http\Resources;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
            return [
                'id'          => $this->id,
                'name'        => $this->name,
                'description' => $this->description,
                'price'       => $this->price,
                'status'      => $this->status,
                'score'       => $this->score,
                'category'    => ProductResource::make($this->whenLoaded('category')),
                'media'       => ProductResource::collection($this->whenLoaded('media')),
                'cart'        => ProductResource::collection($this->whenLoaded('cart'))
            ];
        }
}
