<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    
    public function toArray($request)
    {
         // return parent::toArray($request);
        // On retourne uniquement "name" et "email"
        return [
            "name" => ucfirst($this->name), // La 1er lettre en majuscule
            "email" => $this->email
        ];    }
}
