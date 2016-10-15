@extends('layouts.master')

@section('title')

    <title>Gadgets</title>

    @endsection

@section('content')

    <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li class='active'>Gadgets</li>
    </ol>

    <h2>Gadgets</h2>

    <hr/>

    <gadget-grid></gadget-grid>

    <div> <a href="gadget/create">
            <button type="button" class="btn btn-lg btn-primary">
                Create New
            </button></a>
    </div>


    @endsection