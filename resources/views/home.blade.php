@extends('layouts.app')

@section('content')
    @guest

    @else
    @if (Auth::user()->estado=='1' && Auth::user()->tipo=='C')
    <template>
    <dieta-component></dieta-component>
    </template>
    @endif
    @endguest
@endsection