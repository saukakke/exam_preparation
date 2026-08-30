<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class OrganizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return ['id'=>$this->id,'name'=>$this->name,'slug'=>$this->slug,'type'=>$this->type,'status'=>$this->status,'email'=>$this->email,'phone'=>$this->phone,'website'=>$this->website,'settings'=>$this->settings];
    }
}
