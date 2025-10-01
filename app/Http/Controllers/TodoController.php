<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

final class TodoController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $todos = $user->todos()->orderBy('created_at', 'desc')->get();

        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $data = $request->validated();
        $todo = auth()->user()->todos()->create($data);

        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);

        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, string $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo = update($request->validated());

        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->delete();

        return response()->json(null, 204);
    }

    public function toggle(string $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->completed = ! $todo->completed;
        $todo->save();

        return response()->json($todo);
    }
}
