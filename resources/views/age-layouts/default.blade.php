@extends ('layouts.master')

@section('pageTitle')
    <title>{{ config('app.name', 'Bookster') }} - @yield('title')</title>
@stop

@section('body')
    <header class="grid-x">
        <search @search="search"></search>


    </header>

    <main>
        @yield('main')
    </main>

    <footer>
        <h5>footer</h5>
    </footer>
@stop