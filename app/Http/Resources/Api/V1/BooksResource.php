<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => ( int ) $this->id,
            'type' => 'books',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'publication_year' => $this->publication_year
            ]

        ];
    }
}
