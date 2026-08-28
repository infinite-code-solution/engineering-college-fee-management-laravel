<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FeeStructure;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(FeeStructure::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fee_structure_name' => 'required|string|unique:fee_structures,fee_structure_name',
            'course_id' => 'required|exists:courses,id',
            'academic_year' => 'required|integer',
            'tuition_fee' => 'required|numeric|min:0',
            'jntu_common_service_fee' => 'required|numeric|min:0',
            'exam_fee' => 'required|numeric|min:0',
            'library_fee' => 'required|numeric|min:0',
        ]);

        $feeStructure = FeeStructure::create($validated);
        return response()->json($feeStructure, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feeStructure = FeeStructure::findOrFail($id);
        return response()->json($feeStructure);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feeStructure = FeeStructure::findOrFail($id);

        $validated = $request->validate([
            'fee_structure_name' => 'sometimes|string|unique:fee_structures,fee_structure_name,' . $id,
            'course_id' => 'sometimes|exists:courses,id',
            'academic_year' => 'sometimes|integer',
            'tuition_fee' => 'sometimes|numeric|min:0',
            'jntu_common_service_fee' => 'sometimes|numeric|min:0',
            'exam_fee' => 'sometimes|numeric|min:0',
            'library_fee' => 'sometimes|numeric|min:0',
        ]);

        $feeStructure->update($validated);
        return response()->json($feeStructure);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feeStructure = FeeStructure::findOrFail($id);
        $feeStructure->delete();
        
        return response()->json(null, 204);
    }
}
