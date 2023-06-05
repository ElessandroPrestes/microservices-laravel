<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompany;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $repository;

    public function __construct(Company $model)
    {
        $this->repository = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->repository->with('hero')->get();

        return response([
            'data' => CompanyResource::collection($companies),
            'message' => 'Companies Successfully listed'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCompany $request)
    {
        $company = $this->repository->create($request->validated());

        return response([
            'data'=>new CompanyResource($company),
            'message' => 'Register successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param string $uuid
     */
    public function show($uuid)
    {
        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

        return response(['data'=>new CompanyResource($company),
         'message' => 'Company successfully listed'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param string $uuid
     */
    public function update(StoreUpdateCompany $request, $uuid)
    {
        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

        $company->update($request->validated());

        return response()->json(['message' => 'Updated'], 204);
    }

    /**
     * Remove the specified resource from storage.
     * @param string $uuid
     */
    public function destroy( $uuid)
    {
        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

        $company->delete();

        return response()->json(['message' => 'Deleted'], 204);
    }
}
