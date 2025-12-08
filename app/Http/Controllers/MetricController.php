<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MetricController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'metrics' => Metric::all(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'metric_name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'recorded_date' => 'required|date',
        ]);

        $metric = Metric::create($validated);

        return response()->json([
            'message' => 'Metric created successfully',
            'metric' => $metric,
        ], 201);
    }

    public function show(Metric $metric): JsonResponse
    {
        return response()->json(['metric' => $metric]);
    }

    public function update(Request $request, Metric $metric): JsonResponse
    {
        $validated = $request->validate([
            'metric_name' => 'string|max:255',
            'value' => 'numeric',
            'category' => 'nullable|string|max:255',
            'recorded_date' => 'date',
        ]);

        $metric->update($validated);

        return response()->json([
            'message' => 'Metric updated successfully',
            'metric' => $metric,
        ]);
    }

    public function destroy(Metric $metric): JsonResponse
    {
        $metric->delete();

        return response()->json([
            'message' => 'Metric deleted successfully',
        ]);
    }

    public function byCategory(string $category): JsonResponse
    {
        return response()->json([
            'metrics' => Metric::where('category', $category)->get(),
        ]);
    }

    public function summary(): JsonResponse
    {
        return response()->json([
            'total_metrics' => Metric::count(),
            'categories' => Metric::distinct('category')->count('category'),
            'average_by_category' => Metric::selectRaw('category, avg(value) as average')
                ->groupBy('category')
                ->get(),
        ]);
    }
}
