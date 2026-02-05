<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            // Requirement: Formatted Price
            'price_formatted' => $this->price == 0 ? 'Free' : '$' . number_format($this->price, 2),
            // Requirement: Calculated Field
            'episodes_count' => $this->episodes->count(),
            // Requirement: Teacher Name (Relationship)
            'teacher' => $this->teacher->name,
            'thumbnail' => $this->thumbnail ? asset('storage/' . $this->thumbnail) : null,
        ];
    }
}
