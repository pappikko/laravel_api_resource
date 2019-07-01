<?php

namespace App\Http\Resources;

use App\Services\BmiService;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'height' => $this->height,
            'weight' => $this->weight,
            'BMI' => BmiService::getBmi($this->resource),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
