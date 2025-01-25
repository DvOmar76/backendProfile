<?php

namespace App\Http\Resources;

use App\Http\Resources\SkillResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'company'       => $this->company,
            'description'   => $this->description,
            'imageUrl' =>Storage::disk('public')->url('/public/'.$this->imageUrl),
            'linkCompany'   => $this->linkCompany,
            'typeWork'      => $this->typeWork,
            'locationType'  => $this->locationType,
            'counter'       => $this->counter,
            'city'          => $this->city,
            'start'         => $this->start,
            'end'           => $this->end,
            'total'         => $this->total,
            'certificateUrl' => Storage::disk('public')->url('/public/'.$this->certificateUrl),
            'skills'=> SkillResource::collection($this->whenLoaded('skills'))

        ];
    }
}
