<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Requests\StoreplaceRequest;
use App\Http\Requests\UpdateplaceRequest;
use App\Models\PlaceGroup;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexByGroup($group_id)
    {
        $places = Place::where('place_group_id', $group_id)->get();
        //Order by name
        $places = $places->sortBy('name');
        
        $places->load('scheduleRules');


        $group = $places[0]->group;

        unset($places[0]->group);

        return response()->json([
            'group' => $group,
            'places' => $places
        ]); 
    }

    public function scheduleRules($id)
    {
        $place = Place::where('id', $id)->first();
        
        if ($place->scheduleRules == null) {
            return response()->json([
                'message' => 'No schedule rules found for this place'
            ], 404);
        }
        return response()->json([
            'place' => $place
        ]);
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
    public function store(StoreplaceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $place = Place::where('id', $id)->get();

        return $place;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateplaceRequest $request, place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(place $place)
    {
        //
    }
}
