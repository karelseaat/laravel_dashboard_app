<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnalyticsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'analytics' => Analytics::all(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'user_identifier' => 'nullable|string',
            'data' => 'nullable|json',
        ]);

        $event = Analytics::create($validated);

        return response()->json([
            'message' => 'Event recorded successfully',
            'event' => $event,
        ], 201);
    }

    public function show(Analytics $analytics): JsonResponse
    {
        return response()->json(['event' => $analytics]);
    }

    public function stats(): JsonResponse
    {
        return response()->json([
            'total_events' => Analytics::count(),
            'unique_users' => Analytics::distinct('user_identifier')->count('user_identifier'),
            'events_by_type' => Analytics::selectRaw('event_name, count(*) as count')
                ->groupBy('event_name')
                ->get(),
        ]);
    }
}
