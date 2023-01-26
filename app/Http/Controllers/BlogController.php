<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Admin\Category;
use App\Models\Blog;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('access-blog-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog.index');
    }

    public function indexDatatable(Request $request)
    {
        abort_if(Gate::denies('access-blog-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $data = Blog::select(['id', 'title'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                /*  ->addColumn('action', function ($row) {
                     return view('components.list-button', [
                         'routeDestroy' => route('blogs.destroy', $row->id),
                     ])->render();
                 }) */
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('blogs.show', $row->id) . '" class="view btn btn-info btn-sm pl-2">View</a> ';
                    $btn = $btn . '<a href="' . route('blogs.edit', $row->id) . '" class="edit btn btn-primary btn-sm pl-2">Edit</a> ';
                    $btn = $btn . '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('blog.index_datatable', [
            'columns' => ['title'],
        ]);

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

    public function CkImageStore(Request $request)
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
