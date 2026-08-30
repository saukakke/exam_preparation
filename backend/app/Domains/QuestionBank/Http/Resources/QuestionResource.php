<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return ['id'=>$this->id,'subject_id'=>$this->subject_id,'topic_id'=>$this->topic_id,'type'=>$this->type,'difficulty'=>$this->difficulty,'status'=>$this->status,'stem'=>$this->stem,'explanation'=>$this->when($request->user()?->can('questions.viewAnswers'), $this->explanation),'points'=>$this->points,'negative_marks'=>$this->negative_marks,'version'=>$this->version,'choices'=>$this->whenLoaded('choices')];
    }
}
