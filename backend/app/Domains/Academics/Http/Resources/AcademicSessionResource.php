<?php

declare(strict_types=1);

namespace App\Domains\Academics\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class AcademicSessionResource extends JsonResource
{
    public function toArray(Request $request): array { return ['id'=>$this->id,'organization_id'=>$this->organization_id,'name'=>$this->name,'starts_at'=>$this->starts_at?->toDateString(),'ends_at'=>$this->ends_at?->toDateString(),'status'=>$this->status]; }
}
