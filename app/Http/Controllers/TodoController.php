<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

final class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = auth()->user()->todos()->orderBy('created_at', 'desc')->paginate(15);

        return TodoResource::collection($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = auth()->user()->todos()->create($request->validated());

        return new TodoResource($todo);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('view', $todo);

        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, string $id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('update', $todo);
        $todo->update($request->validated());

        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('delete', $todo);
        $todo->delete();

        return response()->json(null, 204);
    }

    public function toggle(string $id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorize('update', $todo);
        $todo->completed = ! $todo->completed;
        $todo->save();

        return new TodoResource($todo);
    }
}
