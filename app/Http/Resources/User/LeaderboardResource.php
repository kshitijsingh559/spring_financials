<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LeaderboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"    => $this->name,
            "age"     => $this->age,
            "address" => $this->address,
            "points"  => $this->points,
            "qr_code"  => !empty($this->qr_code) ? Storage::url($this->qr_code) : null
        ];
    }
}
