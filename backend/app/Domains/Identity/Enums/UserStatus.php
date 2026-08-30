<?php
declare(strict_types=1);
namespace App\Domains\Identity\Enums;
enum UserStatus: string { case Active='active'; case Suspended='suspended'; case Pending='pending'; case Archived='archived'; }