<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new HomeController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the home page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.index');
    }
}
