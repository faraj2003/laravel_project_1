<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EpisodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'position' => $this->order,
            // Format duration from seconds back to a readable string
            'readable_duration' => $this->duration ? gmdate("i:s", $this->duration) : '00:00',
            'video_link' => $this->video_path ? Storage::url($this->video_path) : null,
        ];
    }
}