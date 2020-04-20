<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class SearchController extends Controller
{
    public function home() {
        return view('search.home');
    }

    public function index() {
        $query = request()->validate([
            'searchTerm' => 'required',
        ]);
        $query = $query['searchTerm'];

        $results = User::where('username', 'LIKE', '%' . $query . '%')->get();
                
        return view('search.index', compact('results'));

    }
}
