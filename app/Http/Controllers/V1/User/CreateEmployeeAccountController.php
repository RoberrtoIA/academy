<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\UserResource;
use App\Services\CreateUserService;

class CreateEmployeeAccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        StoreEmployeeRequest $request,
        CreateUserService $service
    ) {
        return new UserResource($service->createUser($request)->load('roles'));
    }
}
