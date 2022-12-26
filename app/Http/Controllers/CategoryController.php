<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Category;

class CategoryController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:category-read', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['pageTitle'] = 'Category';
        $data['category'] = Category::all();

        return view('category.index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Add Category';
        $data['category'] = Category::all();

        return view('category.create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];
        $custum_message = [
            'name.required' => "nama belum di isi"
        ];
        $this->validate($request, $rules, $custum_message);
        $category = Category::create([
            'name' => $request->name
        ]);
        $category->assignRole($request->role);
        return redirect('/category')->with('message', 'data berhasil di tambahkan');
    }

    public function edit(Category $category)
    {
        $data['pageTitle'] = 'Ubah data kategori';
        $data['category'] = $category;
        $data['roles'] = Role::all();
        $data['categoryRole'] = Category::find($category->id)->roles->pluck('name','name')->all();

        return view('category.edit', $data);
    }

    public function update(Request $request,Category $category)
    {
        $rules = [
            'name' => 'required'
        ];
        $custum_message = [
            'name.required' => "nama belum di isi"
        ];
        $this->validate($request, $rules, $custum_message);
        $category= Category::find($category->id);
        $category->update([
            'name' => $request->name
        ]);
        $category->assignRole($request->role);
        return redirect('/category')->with('message', 'data berhasil di ubah');
    }

    public function show(Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect('/category')->with('message', 'Data telah dihapus');
    }



}
