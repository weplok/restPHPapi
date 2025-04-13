<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        return Queue::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'start_time' => 'required|date',
            'title' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        return Queue::create($data);
    }

    public function show(Queue $queue)
    {
        return $queue->load('user');
    }

    public function update(Request $request, Queue $queue)
    {
        $data = $request->validate([
            'start_time' => 'sometimes|date',
            'title' => 'sometimes|string',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $queue->update($data);
        return $queue;
    }

    public function destroy(Queue $queue)
    {
        $queue->delete();
        return response()->noContent();
    }
}