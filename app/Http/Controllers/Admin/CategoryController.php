<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('access-category-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.index');
    }

    public function create(): View
    {
        abort_if(Gate::denies('add-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        //validatedExcept is custom method that resides in AppServiceProvider
        $category = Category::create($request->validatedExcept('slug'));

        if ($request->hasFile('image')) {
            $filename = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $category->storeImage($request->file('image')->storeAs('category-image', $filename, 'public'), 'single');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category Created Successfully!');
    }

    public function show(Category $category): View
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        abort_if(Gate::denies('edit-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        if ($request->hasFile('image')) {
            $filename = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $category->storeImage($request->file('image')->storeAs('category-image', $filename, 'public'), 'single');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category Updated Successfully!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        abort_if(Gate::denies('delete-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return redirect()->route('admin.categories.index')->with('error', 'Category Deleted Successfully!');
    }

    public function changeCategoryStatus(Request $request): void
    {
        $category = Category::findOrFail($request->category_id);
        $category->is_active = $request->is_active;
        $category->save();
    }

   public function trashed(): View
   {
       return view('admin.category.trash',[
           'categories' => Category::onlyTrashed()->get()
       ]);
   }

    public function restore($id) : RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index')->with('success', 'Category Restored Successfully!');
    }

    public function forceDelete($id) : RedirectResponse
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.index')->with('error', 'Category Eliminated Successfully!');
    }

}
