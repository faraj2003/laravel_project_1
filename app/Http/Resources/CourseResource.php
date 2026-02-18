<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->description,
            
            // Renaming teacher_id to instructor for a cleaner API
            'instructor' => $this->teacher->name ?? 'Unknown Staff',
            
            'is_live' => (bool) $this->is_published,
            
            // NESTED DATA: This will be NULL in the index list, 
            // but will show the full list in the "show" view.
            'syllabus' => EpisodeResource::collection($this->whenLoaded('episodes')),
            
            'created_on' => $this->created_at->format('M d, Y'),
        ];
    }
}