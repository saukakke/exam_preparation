<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class QuestionReviewHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return ['id'=>$this->id,'question_id'=>$this->question_id,'reviewer_id'=>$this->reviewer_id,'action'=>$this->action,'comment'=>$this->comment,'created_at'=>$this->created_at];
    }
}
