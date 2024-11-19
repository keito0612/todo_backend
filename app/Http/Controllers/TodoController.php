<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Response;
use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return response()->json(['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $todo =  new Todo();
        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->save();
        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::findOrFail($id);
        return response()->json($todo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);
        try{
            // IDでTodoを取得
            $todo = Todo::findOrFail($id);
            $todo->title = $request->title;
            $todo->body = $request->body;
            return response()->json(["todo" => $todo, "message" => "updated"],  200);
        }catch(Throwable $e){
            return response()->json([null,"message" => "no update"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json(null, 204);
    }
}
