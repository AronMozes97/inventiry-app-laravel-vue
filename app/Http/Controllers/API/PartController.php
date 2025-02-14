<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartRequest;
use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $parts = Part::with('car')->get();

        return response()->json($parts);
    }

    /**
     * @param PartRequest $request
     * @return JsonResponse
     */
    public function store(PartRequest $request)
    {
        $validatedData = $request->validated();

        $part = Part::create($validatedData);

        return response()->json([
            'message'   => 'Part created successfully',
            'part'      => $part,
        ]);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id)
    {
        $part = Part::with('car')->findOrFail($id);

        return response()->json($part);
    }

    /**
     * @param PartRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(PartRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $part = Part::findOrFail($id);
        $part->update($validatedData);

        return response()->json([
            'message' => 'Part updated successfully.',
            'part' => $part,
        ]);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id)
    {
        $part = Part::findOrFail($id);
        $part->forceDelete();

        return response()->json([
            'message' => 'Part deleted successfully.',
            'id' => $id,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getPartsWithoutCar(): JsonResponse
    {
        $parts = Part::where('car_id', null)->get();

        return response()->json($parts);
    }
}
