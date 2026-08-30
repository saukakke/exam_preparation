<?php
declare(strict_types=1);
namespace App\Domains\Identity\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
final class RegisterRequest extends FormRequest {
 public function authorize(): bool { return true; }
 public function rules(): array { return ['name'=>['required','string','max:120'],'email'=>['required','email','max:255','unique:users,email'],'phone'=>['nullable','string','max:30','unique:users,phone'],'password'=>['required','string','min:12','confirmed']]; }
}