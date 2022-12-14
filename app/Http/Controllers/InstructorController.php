<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Instructor;
use App\Models\PNF;
use App\Services\Input;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = Input::getFilters();
        $search = $request->input('search', '');
        $sortColumn = $request->input('sort', '');
        
        $instructors = Instructor::filters($filters, $sortColumn, $search)
            ->paginate(10)
            ->withQueryString();

        return view('instructors.index', [
            'instructors' => $instructors,
            'filters' => $filters,
            'sort' => $sortColumn,
            'search' => $search,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::getOptions();
        $pnfs = PNF::getOptions();

        return view('instructors.create', [
            'areas' => $areas,
            'pnfs' => $pnfs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:30'],
            'lastname' => ['required', 'max:30'],
            'ci' => ['required', 'integer', 'numeric', 'unique:instructors'],
            'ci_type' => ['required', 'in:V,E'],
            'image' => ['nullable', 'file','image', 'max:2048'],
            'gender' => ['required', 'in:male,female'],
            'phone' => ['required', 'digits:11'],
            'address' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:50', 'unique:instructors'],
            'password' => [
                'required', 'max:50', 'confirmed', 
                Password::min(8)->letters()->mixedCase()->numbers()->symbols()
            ],
            'degree' => ['required', 'max:100'], 
            'area_id' => ['required', 'integer', 'numeric'],
            'birth' => ['required', 'date'],
        ]);

        if (Input::checkFile('image')) {
            $data['image'] = Input::storeFile('image', 'public/profiles');
        } else {
            unset($data['image']);
        }

        Instructor::create($data);

        return redirect()->route('instructors.index')
            ->withSuccess('El instructor se ha a??adido con ??xito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        return view('instructors.show',[
            'instructor' => $instructor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        $areas = Area::getOptions();
        $pnfs = PNF::getOptions();

        return view('instructors.edit', [
            'instructor' => $instructor,
            'areas' => $areas,
            'pnfs' => $pnfs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $uniqueIgnore = Rule::unique('instructors')->ignoreModel($instructor);

        $data = $request->validate([
            'name' => ['required', 'max:30'],
            'lastname' => ['required', 'max:30'],
            'ci' => ['required', 'integer', 'numeric', $uniqueIgnore],
            'ci_type' => ['required', 'in:V,E'],
            'image' => ['nullable', 'file','image', 'max:2048'],
            'gender' => ['required', 'in:male,female'],
            'phone' => ['required', 'digits:11'],
            'address' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:50', $uniqueIgnore],
            'password' => [
                'required', 'max:50', 'confirmed', 
                Password::min(8)->letters()->mixedCase()->numbers()->symbols()
            ],
            'degree' => ['required', 'max:100'], 
            'area_id' => ['required', 'integer', 'numeric'],
            'birth' => ['required', 'date'],
        ]);

        if (Input::checkFile('image')) {
            $data['image'] = Input::storeFile('image', 'public/profiles');
        } else {
            unset($data['image']);
        }

        $instructor->update($data);

        return redirect()->route('instructors.index')
            ->withWarning('El instructor se ha editado con ??xito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('instructors.index')
            ->withDanger('El instructor se ha eliminado con exito');
    }
}
