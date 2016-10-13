<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Widget;
use App\Profile;
use App\Provider;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$Beatles = ['John', 'Paul', 'George', 'Ringo'];

        $profile = Profile::find(4);

        $date = strtotime($profile->birthdate);

        //dd(is_string($date));

        $date = Profile::formDate($date);

        dd($date);

        //alert()->overlay('Problem', 'Cannot hear', 'error');
        //alert()->overlay('Listen', 'I hear Beatle music!', 'success');

        return view('test.index', compact('Beatles', 'widgets'));

    }

    public static function formDate($date)
    {
        $date = strtotime($date);

        return \Carbon\Carbon::parse($date)->format('Y-m-d');


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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
