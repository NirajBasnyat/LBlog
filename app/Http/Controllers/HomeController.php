<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        abort_if(Gate::denies('access-dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('home', [
            'labels' => ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Hello'],
            'new_labels' => ['Anime', 'Cartoon', 'Series', 'Movies'],
            'data' => [12, 19, 3, 5, 2, 3],
            'new_data' => [10, 19, 9, 1],
        ]);
    }
}
