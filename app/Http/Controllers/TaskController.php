<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;

class TaskController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:task-read', ['only' => ['index']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
        $this->middleware('permission:task-do', ['only' => ['do']]);
    }

    public function index()
    {
        $data['pageTitle'] = 'Tugas Tersedia';
        $data['task'] = Task::all();

        return view('task.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Tambah Tugas';
        $data['category'] = Category::all();

        return view('task.create', $data);
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'deadline' => 'required',
            'price' => 'required',
            'limit' => 'required',
            'status' => 'required',
            'image' => 'required',
            'image1' => 'required',
        ];
        $custum_message = [
            'name.required' => "nama belum di isi",
            'description.required' => "Deskripsi belum di isi",
            'category.required' => "Kategori belum di isi",
            'deadline.required' => "Deadline belum di isi",
            'price.required' => "Harga belum di isi",
            'limit.required' => "Batas belum di isi",
            'status.required' => "Status belum di isi",
            'image.required' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'image1.required' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048'
        ];
        $this->validate($request, $rules, $custum_message);

        $file = $request->file('image');
        $imageName =  time() . '.' . $file->getClientOriginalName();
        $path_image = $file->move(base_path() . '/public/images/', $imageName);


        $file1 = $request->file('image1');
        $imageName1 =  time() . '.' . $file1->getClientOriginalName();
        $path_image1 = $file1->move(base_path() . '/public/images/', $imageName1);

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'deadline' => $request->deadline,
            'price' => $request->price,
            'limit' => $request->limit,
            'status' => $request->status,
            'image' => $imageName,
            'path_image' => $path_image,
            'image1' => $imageName1,
            'path_image1' => $path_image1
        ]);
        $task->assignRole($request->role);
        return redirect('/task')->with('message', 'data berhasil di tambahkan');
    }

    public function edit(Task $task)
    {
        $data['pageTitle'] = 'Ubah Tugas';
        $data['task'] = $task;
        $data['category'] = Category::all();
        $data['roles'] = Role::all();
        $data['taskRole'] = Task::find($task->id)->roles->pluck('name', 'name')->all();
        return view('task.edit', $data);
    }

    public function update(Request $request, Task $task)
    {

        $rules = [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'deadline' => 'required',
            'price' => 'required',
            'limit' => 'required',
            'status' => 'required',
        ];
        $custum_message = [
            'name.required' => "nama belum di isi",
            'description.required' => "Deskripsi belum di isi",
            'category.required' => "Kategori belum di isi",
            'deadline.required' => "Deadline belum di isi",
            'price.required' => "Harga belum di isi",
            'limit.required' => "Batas belum di isi",
            'status.required' => "Status belum di isi",

        ];
        $this->validate($request, $rules, $custum_message);
        $task = Task::find($task->id);

        if ($request->hasfile('image')) {
            //dd($request->file('image'));
            if (Task::exists($request->path_image)) {
                Task::destroy($request->path_image);
            }
            $file = $request->file('image');
            $imageName =  time() . '.' . $file->getClientOriginalName();
        $file->move(base_path() . '/public/images/', $imageName);
        } else {
            $imageName = $request->image_value;
       
        }

        if ($request->hasfile('image1')) {
            //dd($request->file('image'));
            if (Task::exists($request->path_image1)) {
                Task::destroy($request->path_image1);
            }
            $file1 = $request->file('image1');
            $imageName1  =  time() . '.' . $file1->getClientOriginalName();
        $file1->move(base_path() . '/public/images/', $imageName1);
        } else {
            $imageName1  = $request->image_value1;
           
        }

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'deadline' => $request->deadline,
            'price' => $request->price,
            'limit' => $request->limit,
            'status' => $request->status,
            'image' => $imageName,
            'image1' => $imageName1,
        ]);
        $task->assignRole($request->role);


        return redirect('/task')->with('message', 'data berhasil di diubah');
    }

    public function show(Task $task)
    {
        //
    }

    
    public function do($id)
    {
        $data['pageTitle'] = 'Tugas Baru';
        $data['task'] = Task::find($id);
        $data['category'] = Category::all();
        $data['roles'] = Role::all();
        return view('task.do', $data);
    }

    public function destroy(Task $task)
    {
        Task::destroy($task->id);

        return redirect('/task')->with('message', 'Data telah dihapus');
    }
}
