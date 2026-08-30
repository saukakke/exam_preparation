<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateQuestionRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['subject_id'=>['sometimes','integer','exists:subjects,id'],'topic_id'=>['sometimes','nullable','integer','exists:question_topics,id'],'type'=>['sometimes','in:multiple_choice,true_false,essay,fill_blank,matching,ordering,drag_drop,coding,diagram,image_based,audio,video,hotspot'],'difficulty'=>['sometimes','in:very_easy,easy,medium,hard,very_hard'],'bloom_level'=>['sometimes','nullable','in:remember,understand,apply,analyze,evaluate,create'],'stem'=>['sometimes','required','string','max:50000'],'explanation'=>['sometimes','nullable','string','max:50000'],'points'=>['sometimes','numeric','min:0','max:100000'],'negative_marks'=>['sometimes','numeric','min:0','max:100000'],'metadata'=>['sometimes','nullable','array'],'source_type'=>['sometimes','string','max:40'],'source_reference'=>['sometimes','nullable','string','max:500']]; }
}
