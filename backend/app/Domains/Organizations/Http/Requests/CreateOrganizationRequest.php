<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateOrganizationRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['name'=>['required','string','max:180'],'type'=>['required','in:school,training_center,university,company,government_agency'],'email'=>['nullable','email','max:255']]; }
}
