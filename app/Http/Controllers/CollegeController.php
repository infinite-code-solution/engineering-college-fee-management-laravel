<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CollegeController extends Controller
{
    public function index(): JsonResponse
    {
        $colleges = College::all();
        return $this->successResponse($colleges, 'Colleges retrieved successfully');
    }

    public function show($id): JsonResponse
    {
        $college = College::find($id);
        if (!$college) {
            return $this->errorResponse('College not found', 404);
        }
        return $this->successResponse($college, 'College retrieved successfully');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'college_name' => 'required|string|max:255',
            'college_code' => 'required|string|max:255|unique:colleges,college_code',
            'college_email' => 'nullable|email|max:255',
            'college_mobile' => 'nullable|string|max:20',
            'college_website' => 'nullable|url|max:255',
            'college_address' => 'nullable|string'
        ]);

        $college = College::create($validated);
        return $this->successResponse($college, 'College created successfully');
    }

    public function update(Request $request, $id): JsonResponse
    {
        $college = College::find($id);
        if (!$college) {
            return $this->errorResponse('College not found', 404);
        }

        $validated = $request->validate([
            'college_name' => 'sometimes|required|string|max:255',
            'college_code' => 'sometimes|required|string|max:255|unique:colleges,college_code,' . $id,
            'college_email' => 'nullable|email|max:255',
            'college_mobile' => 'nullable|string|max:20',
            'college_website' => 'nullable|url|max:255',
            'college_address' => 'nullable|string'
        ]);

        $college->update($validated);
        return $this->successResponse($college, 'College updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        $college = College::find($id);
        if (!$college) {
            return $this->errorResponse('College not found', 404);
        }

        $college->delete(); // Soft deletes handled by model
        return $this->successResponse(null, 'College deleted successfully');
    }
}
