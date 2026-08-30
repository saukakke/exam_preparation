<?php

declare(strict_types=1);

namespace App\Domains\Organizations\Http\Controllers\Api\V1;

use App\Domains\Organizations\Actions\CreateOrganizationAction;
use App\Domains\Organizations\Enums\OrganizationType;
use App\Domains\Organizations\Http\Requests\CreateOrganizationRequest;
use App\Domains\Organizations\Http\Resources\OrganizationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class OrganizationController extends Controller
{
    public function store(CreateOrganizationRequest $request, CreateOrganizationAction $action): JsonResponse
    {
        $organization = $action->execute($request->user(), $request->string('name')->toString(), OrganizationType::from($request->string('type')->toString()), $request->input('email'));
        return (new OrganizationResource($organization))->response()->setStatusCode(201);
    }
}
