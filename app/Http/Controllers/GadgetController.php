<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gadget;
use Illuminate\Support\Facades\Redirect;

class GadgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('gadget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('gadget.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required|unique:gadgets|string|max:30',

        ]);
        $gadget = Gadget::create(['name' => $request->name]);
        $gadget->save();

        return Redirect::route('gadget.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gadget = Gadget::findOrFail($id);

        return view('gadget.show', compact('gadget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gadget = Gadget::findOrFail($id);

        return view('gadget.edit', compact('gadget'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required|string|max:40|unique:gadgets,name,' .$id

        ]);

        $gadget = Gadget::findOrFail($id);

        $gadget->update(['name' => $request->name]);


        return Redirect::route('gadget.show', ['gadget' => $gadget]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Gadget::destroy($id);

        return Redirect::route('gadget.index');

    }
}
