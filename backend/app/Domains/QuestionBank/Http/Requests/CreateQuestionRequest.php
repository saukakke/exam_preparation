<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateQuestionRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['subject_id'=>['required','integer','exists:subjects,id'],'topic_id'=>['nullable','integer','exists:question_topics,id'],'type'=>['required','in:multiple_choice,true_false,essay,fill_blank,matching,ordering,drag_drop,coding,diagram,image_based,audio,video,hotspot'],'difficulty'=>['required','in:very_easy,easy,medium,hard,very_hard'],'stem'=>['required','string','max:50000'],'explanation'=>['nullable','string','max:50000'],'points'=>['required','numeric','min:0','max:100000'],'negative_marks'=>['nullable','numeric','min:0','max:100000'],'metadata'=>['nullable','array']]; }
}
