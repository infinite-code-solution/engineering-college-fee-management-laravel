<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AcademicYear;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AcademicYear::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_name' => 'required|string|unique:academic_years,academic_year_name',
        ]);

        $academicYear = AcademicYear::create($validated);
        return response()->json($academicYear, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return response()->json($academicYear);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $validated = $request->validate([
            'academic_year_name' => 'required|string|unique:academic_years,academic_year_name,' . $id,
        ]);

        $academicYear->update($validated);
        return response()->json($academicYear);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        $academicYear->delete();
        
        return response()->json(null, 204);
    }
}
