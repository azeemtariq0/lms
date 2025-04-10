<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    function __construct() {}
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::query()
                ->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
                ->select('categories.*', DB::raw('IFNULL(parent.name, "No Parent") as parent_name'));

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    $statusLabel = $row->status == 1 ? 'Active' : 'Inactive';
                    $style = $row->status == 1 ? 'bg-green-500 text-white' : 'bg-rose-500 text-white';

                    return '<button class="px-2 py-1 rounded-xl border-none outline-none text-xs cursor-pointer ' . $style . ' change-status" data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fa-solid fa-pencil"></i> ' . $statusLabel . '</button>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="flex items-center justify-center gap-2">
                                <div class="relative group">
                                    <a href="' . route('admin.categories.edit', $row->id) . '" class="edit action-info">
                                        <i class="fa-solid text-gray-500 group-hover:text-blue-600 fa-pencil transition-all"></i>
                                    </a>
                                    <span class="tooltip-top-center group-hover:!block">Edit Row</span>
                                </div>
                                <div class="relative group">
                                    <a href="' . route('admin.categories.destroy', $row->id) . '" class="delete action-danger">
                                        <i class="fa-solid text-gray-500 group-hover:text-rose-600 fa-trash transition-all"></i>
                                    </a>
                                    <span class="tooltip-top-center group-hover:!block">Delete Row</span>
                                </div>
                            </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $data['page_management'] = [
            'page_title' => 'Categories',
            'title' => 'Categories',
            'slug' => 'Admin'
        ];
        return view('admin.categories.index', compact('data'));
    }
    public function create()
    {
        $categories = Category::where('parent_id','=',0)->get();

        $data['page_management'] = array(
            'page_title' => 'Add Categories',
            'title' => 'Add Categories',
            'slug' => 'Add',
        );
        return view('admin.categories.create', compact('data', 'categories'));
    }

    public function list(Request $request)
    {
        $search = $request->input('search', '');
        $onlyParent = $request->input('onlyParent', false);
        $onlyChild = $request->input('onlyChild', false);


        $list = Category::when($search, function ($query) use ($search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        if ($onlyParent) {
            $list = $list->where('parent_id',0);
        } else if ($onlyChild) {
          $list = $list->where('parent_id','<>',0);
        }
        $list = $list->orderBy('name')
            ->paginate(10, ['id', 'name']);

        return response()->json([
            'results' => $list->items(),
            'pagination' => [
                'more' => $list->hasMorePages()
            ]
        ]);
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


   public function store(Request $request )
    {
           $this->validate($request, [
            'name' => 'required',
        ]);
        
        $input = $request->all();
        $user = Category::create($input);
        
        return redirect()->route('admin.categories.index')
        ->with('success','Category created successfully');
    }
     public function show($id)
    {
        $category = Category::find($id);
        $data['page_management'] = array(
            'page_title' => 'Show Categories',
            'title' => 'Show Categories',
            'slug' => 'View',
        );

        return view('admin.categories.create',compact('category' ,'data'));
    }

    public function edit($id)
    {

        $category = Category::find($id);
        $categories = Category::where('id', '!=', $id)->where('parent_id', '=', 0)->get();

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