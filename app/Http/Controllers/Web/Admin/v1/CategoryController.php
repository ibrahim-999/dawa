<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Product\v1\Services\CategoryService;
use App\Domains\Vendor\v1\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CategoryStoreRequest;
use App\Http\Requests\Product\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    private CategoryService $categoryService;


    public function __construct(
        CategoryService       $categoryService,

    )
    {
        $this->categoryService = $categoryService;

        $this->middleware('permission:create_categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_categories', ['only' => ['show']]);
        $this->middleware('permission:update_categories', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_categories', ['only' => ['index']]);
        $this->middleware('permission:delete_categories', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;

        $categories_tree = $this->categoryService->with(['childs','translation']);
        $categories_tree = $categories_tree
            ->activeCategories()
            ->grandParents()
            ->sort('id','DESC')
            ->index();

        $categories = $this->categoryService->reset()->with(['childs','translation']);
        $categories = $categories->search($request)
            ->activeCategories()
            ->sort('id','DESC')
            ->paginate($itemsPerPage);
        return view('admin/v1/category/index', compact('categories_tree','categories'));
    }

    public function create()
    {
        $categories_tree = $this->categoryService->with(['childs','translation']);
        $categories_tree = $categories_tree
            ->activeCategories()
            ->grandParents()
            ->index();

        $categories = $this->categoryService->reset()->with(['childs','translation']);
        $categories = $categories
            ->activeCategories()
            ->parentableCategories()
            ->index()->pluck('title','id');
        return view('admin/v1/category/create',compact('categories_tree','categories'));
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryService->add($request);
        if ($category) {
            return Redirect::route('categories.index')->with('success', __('messages.category_created_successfully'));
        } else {
            return Redirect::back();
        }

    }


    public function destroy(Category $category)
    {
        $deleted = $this->categoryService->delete($category);
        if ($deleted) {
            return Redirect::route('categories.index')->with('success', __('messages.category_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('categories.index')->with('success', __('messages.category_deleted_successfully'));
    }

    public function edit(Category $category)
    {
        $categories_tree = $this->categoryService->with(['childs','translation']);
        $categories_tree = $categories_tree
            ->activeCategories()
            ->grandParents()
            ->index();

        $categories = $this->categoryService->reset()->with(['childs','translation']);
        $categories = $categories
            ->activeCategories()
            ->index()->pluck('title','id');
        return view('admin/v1/category/edit', compact('categories_tree','categories','category'));
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $updated = $this->categoryService->setBuilder($category)->update($request);
        if ($updated) {
            return Redirect::route('categories.index')->with('success', __('messages.category_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
