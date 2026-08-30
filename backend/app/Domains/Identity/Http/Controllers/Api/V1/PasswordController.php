<?php

declare(strict_types=1);

namespace App\Domains\Identity\Http\Controllers\Api\V1;

use App\Domains\Identity\Actions\ChangePasswordAction;
use App\Domains\Identity\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class PasswordController extends Controller
{
    public function update(ChangePasswordRequest $request, ChangePasswordAction $action): JsonResponse
    {
        $action->execute($request->user(), $request->string('password')->toString());
        return response()->json(['message' => 'Password changed successfully.']);
    }
}
