<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Services\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableClubController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Estudiante');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $filters = Input::getFilters();
        $search = $request->query('search');
        $sortColumn = $request->query('sort');

        $clubs = Club::where('status', 'Activo')
            ->notJoinedBy($user)
            ->search($search)
            ->sort($sortColumn)
            ->filters($filters)
            ->paginate(10)
            ->withQueryString();
        
        return view('available-clubs.index', [
            'clubs' => $clubs,
            'filters' => $filters,
            'sort' => $sortColumn,
            'search' => $search,
        ]);
    }
}
