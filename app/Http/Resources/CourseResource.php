<?php

namespace App\Http\Resources;

use App\Http\Resources\SkillResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'imageUrl' =>Storage::disk('public')->url('/public/'.$this->imageUrl),
            'certificateUrl' => Storage::disk('public')->url('/public/'.$this->certificateUrl),
            'skills'=> SkillResource::collection($this->whenLoaded('skills'))
        ];
    }
}
