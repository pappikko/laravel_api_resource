<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\StorePerson;
use App\Http\Requests\UpdatePerson;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonCollection;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Person $person)
    {
        return new PersonCollection($person->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Person $person, StorePerson $request)
    {
        $p = $person->create(
            [
                'name' => $request->input('name'),
                'height' => $request->input('height'),
                'weight' => $request->input('weight'),
            ]
        );

        return new PersonResource($p);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return new PersonResource($person);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerson $request, Person $person)
    {
        $isUpdated = false;
        if ($request->input('name')) {
            $person->name = $request->input('name');
            $isUpdated = true;
        }
        if ($request->input('height')) {
            $person->height = $request->input('height');
            $isUpdated = true;
        }
        if ($request->input('weight')) {
            $person->weight = $request->input('weight');
            $isUpdated = true;
        }

        if ($isUpdated) {
            $person->save();
        }

        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return new PersonResource($person);
    }
}
