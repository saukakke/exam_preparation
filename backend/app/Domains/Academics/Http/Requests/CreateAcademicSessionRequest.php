<?php

declare(strict_types=1);

namespace App\Domains\Academics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateAcademicSessionRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['organization_id'=>['required','integer','exists:organizations,id'],'name'=>['required','string','max:120'],'starts_at'=>['required','date'],'ends_at'=>['required','date','after:starts_at']]; }
}
