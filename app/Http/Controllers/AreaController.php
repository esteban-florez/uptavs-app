<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use App\Models\PNF;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Area::class);
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $areas = Area::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })->orderBy('id', 'desc')
            ->paginate(9)
            ->withQueryString();

        $pnfs = PNF::getOptions();

        return view('areas', [
            'areas' => $areas,
            'pnfs' => $pnfs,
            'search' => $search,
        ]);
    }

    public function store(StoreAreaRequest $request)
    {
        $data = $request->validated();

        Area::create($data);

        return back()
            ->with('alert', trans('alerts.areas.created'));
    }

    public function edit(Area $area)
    {
        $areas = Area::latest()
            ->paginate(9)
            ->withQueryString();

        $pnfs = PNF::getOptions();

        return view('areas', [
            'areas' => $areas,
            'areaToEdit' => $area,
            'pnfs' => $pnfs
        ]);
    }

    public function update(UpdateAreaRequest $request, Area $area)
    {
        $data = $request->validated();

        $area->update($data);

        return redirect()->route('areas.index')
            ->with('alert', trans('alerts.areas.updated'));
    }
}
