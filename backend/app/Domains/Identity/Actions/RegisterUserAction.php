<?php
declare(strict_types=1);
namespace App\Domains\Identity\Actions;
use App\Domains\Identity\DTOs\RegisterUserData;
use App\Domains\Identity\Models\User;
use App\Domains\Identity\Enums\UserStatus;
final readonly class RegisterUserAction {
 public function execute(RegisterUserData $data): User {
  return User::query()->create(['name'=>$data->name,'email'=>$data->email,'phone'=>$data->phone,'password'=>$data->password,'status'=>UserStatus::Pending]);
 }
}