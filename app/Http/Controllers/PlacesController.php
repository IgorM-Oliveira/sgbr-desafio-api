<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlacesRequest;
use App\Http\Requests\UpdatePlacesRequest;
use App\Http\Resources\PlacesResource;
use App\Models\Places;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('name');

        $placesQuery = Places::orderBy('name', 'asc');

        if ($searchTerm !== null && $searchTerm !== '') {
            $placesQuery->where(function ($query) use ($searchTerm) {
                $lowerSearchTerm = strtolower($searchTerm);
                $query->where('name', 'ILIKE', "%$lowerSearchTerm%");
            });
        }

        return PlacesResource::collection($placesQuery->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlacesRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $place = Places::create($data);
        return response()->json($place, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $places = Places::findOrFail($id);
        return response()->json($places);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Places $places)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlacesRequest $request, $id)
    {
        $data = $request->validated();

        $places = Places::findOrFail($id);
        $places->update($data);
        return response()->json($places);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $places = Places::findOrFail($id);
        $places->delete();
        
        return response()->json(['message' => 'Lugar removido']);
    }
}
