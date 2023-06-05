<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateHero;
use App\Http\Resources\HeroResource;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{

    protected $repository;

    public function __construct(Hero $model)
    {
        $this->repository = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = $this->repository->get();

        return response([
            'data' => HeroResource::collection($heroes),
            'message' => 'Heroes Successfully listed'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateHero $request)
    {
        $hero = $this->repository->create($request->validated());

        return response([
            'data'=>new HeroResource($hero),
            'message' => 'Register successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param int id
     */
    public function show($id)
    {
        $hero = $this->repository->where('id', $id)->firstOrFail();

        return response(['data'=>new HeroResource($hero),
         'message' => 'Hero successfully listed'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param int id
     */
    public function update(StoreUpdateHero $request, $id)
    {
        $hero = $this->repository->where('id', $id)->firstOrFail();

        $hero->update($request->validated());

        return response()->json(['message' => 'success'], 204);
    }

    /**
     * Remove the specified resource from storage.
     * @param int id
     */
    public function destroy($id)
    {
        $hero = $this->repository->where('id', $id)->firstOrFail();

        $hero->delete();

        return response()->json([], 204);
    }
}
