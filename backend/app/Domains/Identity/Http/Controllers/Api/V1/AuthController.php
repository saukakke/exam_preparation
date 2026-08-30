<?php
declare(strict_types=1);
namespace App\Domains\Identity\Http\Controllers\Api\V1;
use App\Domains\Identity\Actions\RegisterUserAction;
use App\Domains\Identity\DTOs\RegisterUserData;
use App\Domains\Identity\Http\Requests\LoginRequest;
use App\Domains\Identity\Http\Requests\RegisterRequest;
use App\Domains\Identity\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
final class AuthController extends Controller {
 public function register(RegisterRequest $request, RegisterUserAction $action): JsonResponse { $user=$action->execute(new RegisterUserData(...$request->safe()->only(['name','email','password','phone']))); $token=$user->createToken('web')->plainTextToken; return response()->json(['data'=>['user'=>new UserResource($user),'token'=>$token]],201); }
 public function login(LoginRequest $request): JsonResponse { $user=\App\Domains\Identity\Models\User::query()->where('email',$request->string('email'))->first(); if(!$user || !Hash::check($request->string('password'),$user->password)) abort(422,'Invalid credentials.'); $token=$user->createToken($request->string('device_name'))->plainTextToken; return response()->json(['data'=>['user'=>new UserResource($user),'token'=>$token]]); }
 public function logout(): JsonResponse { request()->user()->currentAccessToken()?->delete(); return response()->json(status:204); }
}