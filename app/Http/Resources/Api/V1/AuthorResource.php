<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'type' => 'authors',
            'attributes' => [
                'name' => $this->name,
                'joined_date' => \Carbon\Carbon::parse($this->created_at)->toDayDateTimeString(),
                'updated_date' => \Carbon\Carbon::parse($this->updated_at)->toDayDateTimeString(),
            ]
        ];
    }
}
