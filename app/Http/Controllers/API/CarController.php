<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cars = Car::with('parts')->get();

        return response()->json($cars);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $validatedData = $request->validated();

        $car = Car::create($validatedData);

        return response()->json([
                'message' => 'Car created successfully',
                'car' => $car
            ]
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = Car::with('parts')->findOrFail($id);

        return response()->json($car);
    }

    /**
     * @param CarRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CarRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $car = Car::findOrFail($id);
        $car->update($validatedData);

        return response()->json([
            'message' => 'Car updated successfully.',
            'car' => $car,
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $car = Car::findOrFail($id);
        $car->forceDelete();

        return response()->json([
            'message' => 'Car archived successfully.',
            'id' => $id,
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function archive(int $id): JsonResponse
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return response()->json([
            'message' => 'Car archived successfully.',
            'id' => $id,
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function removePart(int $id): JsonResponse
    {
        $part = Part::findOrFail($id);

        $part->car_id = null;
        $part->save();

        return response()->json([
            'message' => 'Part removed successfully.',
            'part' => $part,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getArchivedCars(): JsonResponse
    {
        $cars = Car::onlyTrashed()->get();

        return response()->json($cars);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function revokeCar(int $id): JsonResponse
    {
        $car = Car::withTrashed()->findOrFail($id);
        $car->restore();

        return response()->json([
            'message' => 'Car restored successfully.',
            'car' => $car,
        ]);
    }

    /**
     * @param int $carId
     * @param int $partId
     * @return JsonResponse
     */
    public function addPartToCar(int $carId, int $partId): JsonResponse
    {
        $part = Part::findOrFail($partId);
        $carId = Car::findOrFail($carId);

        $part->car_id = $carId->id;
        $part->save();

        return response()->json([
            'message' => 'Part added to car successfully.',
            'part' => $part,
        ]);
    }
}
