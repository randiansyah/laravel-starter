<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\Wallet;

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

        $todo = Todo::where([
            'task_id' => $request->task_id,
            'user_id' => $request->user_id,
        ])->count();

        if ($todo < 1) {
            $task = Task::select('limit')->first();
            $todo = Todo::where('task_id', $request->task_id)->get();
            $count = $todo->count();

            if ($task->limit > $count) {
                // dd("data bisa masuk");
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
                return redirect('/todo')->with('message', 'Terima kasih !, Tugas berhasil dikirim');
            } else {
                ///  dd("data melebihi batas");
                return redirect('/task')->withErrors(['message' => 'Mohon Maaf !, Tugas sudah melebihi kouta']);
            }

            // dd($task, $count);

        } else {
            $todoUpdate = Todo::where([
                'task_id' => $request->task_id,
                'user_id' => $request->user_id,
            ])->first();



            if ($todoUpdate->status == 'failed') {
                return redirect('/task')->withErrors(['message' => 'Mohon Maaf !, Tugas yang anda kerjakan belum berhasil, harap mengerjakan tugas baru']);
            } else {
                if ($request->hasfile('image')) {
                    //dd($request->file('image'));
                    if (Todo::exists(base_path() . '/public/images/upload/', $todoUpdate->image)) {
                        Todo::destroy(base_path() . '/public/images/upload/', $todoUpdate->image);
                    }
                    $file = $request->file('image');
                    $imageName =  time() . '.' . $file->getClientOriginalName();
                    $file->move(base_path() . '/public/images/upload', $imageName);
                } else {
                    $imageName = $todoUpdate->image;
                }

                if ($request->hasfile('image1')) {
                    //dd($request->file('image'));
                    if (Todo::exists(base_path() . '/public/images/upload/', $todoUpdate->image1)) {
                        Todo::destroy(base_path() . '/public/images/upload/', $todoUpdate->image1);
                    }
                    $file1 = $request->file('image1');
                    $imageName1 =  time() . '.' . $file1->getClientOriginalName();
                    $file1->move(base_path() . '/public/images/upload', $imageName1);
                } else {
                    $imageName1 = $todoUpdate->image1;
                }

                $todoUpdate->update([
                    'description' => $request->description,
                    'image' => $imageName,
                    'image1' => $imageName1,
                    'status' => 'pending',
                ]);
                $todoUpdate->assignRole($request->role);


                return redirect('/todo')->with('message', 'data berhasil di diubah');
            }
        }
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

        $todo = Todo::find($todo->id);
        $todo->status = Str::lower($request->status);
        $todo->comment = Str::lower($request->comment);
        $todo->save();

        if ($request->status == 'success') {


            $cek = Wallet::where([
                'task_id' => $request->task_id,
                'user_id' => $request->user_id,
            ])->count();

            if ($cek > 0) {
                $walletUpdate =  Wallet::where([
                    'task_id' => $request->task_id,
                    'user_id' => $request->user_id,
                ])->first();
                $walletUpdate->update([
                    'user_id' => $request->user_id,
                    'task_id' => $request->task_id,
                    'total' => $request->price,
                    'virtual_id' => 0,
                    'status' => 'paid',
                    'type' => 'deposit',
                    'desc' => 'Penambahan dana'
                ]);
                return redirect('/todo')->with('message', 'Data telah diubah ke wallet');
            } else {
                $wallet = Wallet::create([
                    'user_id' => $request->user_id,
                    'task_id' => $request->task_id,
                    'total' => $request->price,
                    'virtual_id' => 0,
                    'status' => 'paid',
                    'type' => 'deposit',
                    'desc' => 'Penambahan dana'
                ]);
                return redirect('/todo')->with('message', 'Data telah ditambahkan ke wallet');
            }
        } else {

            return redirect('/todo')->with('message', 'Data telah diubah');
        }
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
