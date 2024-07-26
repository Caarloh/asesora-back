<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Sector::all();
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nombre' => 'required|max:30',
                'vigencia' => 'required|boolean',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }

        $sectorCreated = Sector::create($request->all());

        return $sectorCreated;
    }

    /**
     * Display the specified resource.
     */
    public function show(Sector $sector)
    {
        return $sector;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sector $sector)
    {
        try{
            $request->validate([
                'nombre' => 'required|max:30',
                'vigencia' => 'required|boolean',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }

        $sector->update($request->all());

        return $sector;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();

        $response = [
            'message' => " Sector $sector deleted successfully", 
        ];

        return response()->json($response, 200);
    }
}
