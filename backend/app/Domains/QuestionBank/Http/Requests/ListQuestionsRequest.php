<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ListQuestionsRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['subject_id'=>['nullable','integer','exists:subjects,id'],'topic_id'=>['nullable','integer','exists:question_topics,id'],'difficulty'=>['nullable','string','in:very_easy,easy,medium,hard,very_hard'],'type'=>['nullable','string','in:multiple_choice,true_false,essay,fill_blank,matching,ordering,drag_drop,coding,diagram,image_based,audio,video,hotspot'],'bloom_level'=>['nullable','string','in:remember,understand,apply,analyze,evaluate,create'],'status'=>['nullable','string','in:draft,in_review,approved,rejected,archived'],'search'=>['nullable','string','max:500'],'per_page'=>['nullable','integer','min:1','max:100'],'sort'=>['nullable','in:created_at,updated_at,difficulty,points'],'direction'=>['nullable','in:asc,desc']]; }
}
