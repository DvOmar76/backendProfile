<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SocialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd(Storage::disk('public')->url('/public/'.$this->iconUrl));
        return [
            'title'=>$this->title,
            'iconUrl' =>Storage::disk('public')->url('/public/'.$this->iconUrl),
            'link'=>$this->link
        ];
    }
}
