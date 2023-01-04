<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:todo-read', ['only' => ['index']]);
        $this->middleware('permission:todo-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:todo-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:todo-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Tugas yang dikerjakan';
        if (Auth::id() === 1) {
           // $todo = Todo::all();
            $todo = Todo::join('users', 'todos.user_id', '=', 'users.id')
            ->select('todos.*', 'users.name AS namanya')
            ->get();

        } else {
            $todo = Todo::where('user_id', Auth::id())->latest()->paginate(5);
        }
    

        $data['todo'] =  $todo;
        return view('todo.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Tugas';

        return view('task.create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'image' => 'required',
            'image1' => 'required',
            'description' => 'required',
        ];
        $message = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'description' => 'Keterangan belum diisi',
        ];

        $this->validate($request, $rules, $message);
        $file = $request->file('image');
        $imageName =  time() . '.' . $file->getClientOriginalName();
        $file->move(base_path() . '/public/images/upload/', $imageName);

        $file1 = $request->file('image1');
        $imageName1 =  time() . '.' . $file1->getClientOriginalName();
        $file1->move(base_path() . '/public/images/upload/', $imageName1);

        $todo = Todo::create([
            'task_id' => $request->task_id,
            'user_id' => $request->user_id,
            'price' => $request->price,
            'name' => $request->name,
            'image' => $imageName,
            'image1' => $imageName1,
            'description' => $request->description,
            'comment' => ''
        ]);

        // dd($request);

        $todo->assignRole($request->role);
        return redirect('/todo')->with('message', 'terima kasih !!, Tugas berhasil di kirim, harap menunggu konfimasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
