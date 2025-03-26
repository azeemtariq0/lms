<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Banner;
use DB;
use DataTables, Form;

class CategoryController extends Controller
{
    function __construct() {}
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  $data = Category::query()
                ->leftJoin('category as parent', 'category.parent_id', '=', 'parent.id') // Alias the parent table
                ->select('category.*', 'parent.name as parent_name');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('parent_name', function ($row) {
                    return $row->parent_name ? $row->parent_name : '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = "<div class='flex items-center justify-center gap-2'>";

                    $btn .= "<div class='relative group'>
                            <a href='" . route('admin.categories.edit', $row->id) . "' class='edit action-info'><i
                                class='fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all'></i></a>
                            <span class='tooltip-top-center group-hover:!block'>Edit Row</span>
                        </div>";

                    $btn .= "<div class='relative group'>
                            <a href='" . route('admin.categories.destroy', $row->id) . "' class='delete action-danger'><i
                            class='fa-solid text-gray-500 group-hover:text-rose-600 fa-trash transition-all'></i></a>
                            <span class='tooltip-top-center group-hover:!block'>Delete Row</span>
                            </div>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    $btn = '';
                    $statusLabel = $row->status == 1 ? 'Active' : 'Inactive';
                    $style = $row->status == 1 ? 'bg-green-500 text-white' : 'bg-rose-500 text-white';

                    $btn .= '<button class="px-2 py-1 rounded-xl border-none outline-none text-xs cursor-pointer ' . $style . ' change-status" data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fa-solid fa-pencil " ></i> ' . $statusLabel . '</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data['page_management'] = array(
            'page_title' => 'Categories',
            'title' => 'Categories',
            'slug' => 'Admin'
        );
        return view('admin.categories.index', compact('data'));
    }
    public function create()
    {
        $categories = Category::get();

        $data['page_management'] = array(
            'page_title' => 'Add Categories',
            'title' => 'Add Categories',
            'slug' => 'Add',
        );
        return view('admin.categories.create', compact('data', 'categories'));
    }

    public function changeStatus(Request $request)
    {
        $banner = Category::find($request->id);

        if ($banner) {
            $banner->status = $request->status;
            $banner->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();
        $user = Category::create($input);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }
    public function show($id)
    {
        $category = Category::find($id);
        $data['page_management'] = array(
            'page_title' => 'Show Categories',
            'title' => 'Show Categories',
            'slug' => 'View',
        );

        return view('admin.categories.create', compact('category', 'data'));
    }

    public function edit($id)
    {

        $category = Category::find($id);
        $categories = Category::where('id', '!=', $id)->get();

        $data['page_management'] = array(
            'page_title' => 'Categories',
            'slug' => 'Edit',
            'title' => 'Edit Categories',
            'add' => 'Edit Categories',
        );

        return view('admin.categories.create', compact('category', 'categories', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        $user = Category::find($id);
        $input['name'] = trim($input['name']);

        $user->update($input);


        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
