<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class QuestionChoiceRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['content'=>['required','string','max:20000'],'is_correct'=>['required','boolean'],'position'=>['required','integer','min:1','max:100'],'metadata'=>['nullable','array']]; }
}
