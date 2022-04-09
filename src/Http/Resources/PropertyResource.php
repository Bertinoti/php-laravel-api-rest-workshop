<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'street' => $this->street,
            'number' => $this->number,
            'city' => $this->city,
            'province' => $this->province,
            'country' => $this->country,
            'status' => $this->status,
            'type' => $this->type,
            'description' => $this->description,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'condition' => $this->condition,
            'room' => $this->room,
            'bath' => $this->bath,
            'size' => $this->size,
            'price' => $this->price,
            'pet' => $this->pet,
            'garden' => $this->garden,
            'air_conditioning' => $this->air_conditioning,
            'swimming_pool' => $this->swimming_pool,
            'terrace' => $this->terrace,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
            //Be Careful with the UserResouce
            'users' => UserResource::collection($this->users)
        ];
    }

}
