<?php
declare(strict_types=1);
namespace App\Domains\Identity\DTOs;
final readonly class RegisterUserData {
 public function __construct(public string $name, public string $email, public string $password, public ?string $phone=null) {}
}