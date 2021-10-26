<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Job;
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

    #[Route("/", methods: ["GET"])]
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var $collection */
        $collection = Job::query()
            ->hasFiltered()
            ->onlyActive()
            ->latest('id');

        return view('pages.index', [
            'collection' => $collection->simplePaginate($request->per_page),
            'total' => $collection->count()
        ]);
    }

    #[Route("/{job:uuid}", methods: ["GET"])]
    public function show(Job $job): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.show', ['job' => $job->load('user')]);
    }
}
