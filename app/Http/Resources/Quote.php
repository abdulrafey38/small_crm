<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Quote extends JsonResource
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
            'service_id' => $this->service_id,
            'service' => $this->service,
            'message' => $this->message,
            'status' => $this->status,
            'name' => $this->customer->name,
            'phone' => $this->customer->phone,
            'email' => $this->customer->email,
            'isNew' => $this->is_new,
        ];

        // return parent::toArray($request);
    }
}
