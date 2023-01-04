<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RoleResource
 *
 * @package App\Http\Resources
 * @mixin Role
 */
class RoleResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'guard_name' => $this->guard_name,
        ];
    }
}
