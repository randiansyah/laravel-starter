<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Task;
use App\Models\Category;

class TaskController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:task-read', ['only' => ['index']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
        
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

}
