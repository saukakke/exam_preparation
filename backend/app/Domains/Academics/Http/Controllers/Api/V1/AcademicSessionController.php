<?php

declare(strict_types=1);

namespace App\Domains\Academics\Http\Controllers\Api\V1;

use App\Domains\Academics\Actions\CreateAcademicSessionAction;
use App\Domains\Academics\Http\Requests\CreateAcademicSessionRequest;
use App\Domains\Academics\Models\AcademicSession;
use App\Domains\Academics\Http\Resources\AcademicSessionResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class AcademicSessionController extends Controller
{
    public function store(CreateAcademicSessionRequest $request, CreateAcademicSessionAction $action): JsonResponse
    {
        $data = $request->validated();
        $session = $action->execute((int)$data['organization_id'], $data['name'], $data['starts_at'], $data['ends_at']);
        return (new AcademicSessionResource($session))->response()->setStatusCode(201);
    }

    public function index(CreateAcademicSessionRequest $request): JsonResponse
    {
        $sessions = AcademicSession::query()->where('organization_id', $request->integer('organization_id'))->latest('starts_at')->paginate();
        return AcademicSessionResource::collection($sessions)->response();
    }
}
