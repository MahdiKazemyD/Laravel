<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        if (empty($this->id)){
//            return [$this] ;
//        }

        return [
            'id'        => $this->id ,
            'name'      => $this->name,
            'user_id'   => $this->user_id,
            'parent_id' => $this->parent_id,
            'parent'    => CategoryResource::make($this->whenLoaded('parent')),
            'children'  => CategoryResource::collection($this->whenLoaded('children')),
            'product'   => CategoryResource::collection($this->whenLoaded('product')),
        ];
    }
}
