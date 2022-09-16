<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Categories;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogRequest;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('access-blog-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog.index');
    }

    public function create(): View
    {
        abort_if(Gate::denies('add-blog'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog.create', [
            'categories' => Category::where('is_active', 1)->get(['id', 'name'])
        ]);
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $blog = auth()->user()->blogs()->create($request->validated());

        $blog->categories()->attach($request->categories);

        return redirect()->route('blogs.index')->with('success', 'Blog Created Successfully!');
    }

    public function show(Blog $blog): View
    {
        return view('blog.show', [
            'blog' => $blog->load('categories')
        ]);
    }

    public function edit(Blog $blog): View
    {
        abort_if(Gate::denies('edit-blog'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog.edit', [
            'blog' => $blog,
            'categories' => Category::where('is_active', 1)->get(['id', 'name'])
        ]);
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $blog->update($request->validated());

        $blog->categories()->sync($request->categories);

        return redirect()->route('blogs.index')->with('success', 'Blog Updated Successfully!');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        abort_if(Gate::denies('delete-blog'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();

        return redirect()->route('blogs.index')->with('error', 'Blog Deleted Successfully!');
    }

    public function trashed(): View
    {
        return view('blog.trash', [
            'blogs' => Blog::onlyTrashed()->get()
        ]);
    }

    public function restore($id): RedirectResponse
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        return redirect()->route('blogs.index')->with('success', 'Blog Restored Successfully!');
    }

    public function forceDelete($id): RedirectResponse
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->forceDelete();

        return redirect()->route('blogs.index')->with('error', 'Blog Eliminated Successfully!');
    }

    public function CkImageStore(Request$request)
    {
        if ($request->hasFile('upload')) {
            $filename = time() . '.' . $request->file('upload')->getClientOriginalExtension();

            $request->file('upload')->move(public_path('blog_media'), $filename);

            $url = asset('blog_media/' . $filename);

            return response()->json([
                'filename' => $filename,
                'uploaded' => 1,
                'url' => $url
            ]);
        }
    }
}
