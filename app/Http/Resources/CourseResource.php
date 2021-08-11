<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identify' => $this->uuid,
            'title' => $this->name,
            'description' => $this->description,
            'date' => Carbon::make($this->created_at)->format('Y-m-d'),
            'modules' => ModuleResource::collection($this->whenLoaded('modules'))
        ];
    }
}
