<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
                 // If simple flag is present, return minimal data
                 if ($request->has('simple')) {
                    return [
                        'id' => $this->id,
                        'name' => $this->name,
                        'avatar' => $this->avatar,
                    ];
                }
                $avatarUrl =  $this->avatar ?? $this->getFirstMediaUrl('avatar') ?? null;
                $avatar = $avatarUrl ? $avatarUrl : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
        
        
                return [
                    'id' => $this->id,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone ?? null,
                    'avatar' => $avatar,
                    'role' => $this->roles->first()->name ?? 'customer',
                    'isAdmin' => $this->hasRole('admin'),
                    'country' => $this->country,
                    'country_code' => $this->country_code,
                    'region' => $this->region,
                    'city' => $this->city,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                ];
    }
}
