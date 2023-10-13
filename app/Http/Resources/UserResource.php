<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'    => 'success',
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'api_token' => $this->api_token,
            'admin'     => $this->is_Admin,
            'active'    => $this->is_Active, ];
    }
}
