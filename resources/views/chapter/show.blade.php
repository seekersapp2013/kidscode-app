@extends('voyager::master')

@section('content')


    @if($hasAccess)
        <p>You have access to this course</p>
    @else
        <p>You do not have access to this course</p>
    @endif

@stop