<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'video' => $this->video,
            'description' => $this->description,
            'date' => Carbon::make($this->created_at)->format('Y-m-d'),
        ];
    }
}
