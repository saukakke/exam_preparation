<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class QuestionTopicResource extends JsonResource
{
    public function toArray(Request $request): array { return ['id'=>$this->id,'subject_id'=>$this->subject_id,'parent_id'=>$this->parent_id,'name'=>$this->name,'slug'=>$this->slug,'description'=>$this->description,'children'=>$this->whenLoaded('children')]; }
}
