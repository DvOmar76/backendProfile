<?php

namespace App\Http\Resources\AR;

use App\Http\Resources\SkillResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResourceAR extends JsonResource
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
            'imageUrl'      => $this->imageUrl,
            'linkCompany'   => $this->linkCompany,
            'typeWork'      => $this->typeWork,
            'locationType'  => $this->locationType,
            'counter'       => $this->counter,
            'city'          => $this->city,
            'start'         => $this->start,
            'end'           => $this->end,
            'total'         => $this->total,
            'certificateUrl'=> $this->certificateUrl,
            'skills'=> SkillResource::collection($this->whenLoaded('skills'))
        ];
    }
}
