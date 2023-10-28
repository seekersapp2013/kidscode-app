@extends('voyager::master')

@section('content')
<h2>All Courses</h2>

<div class=" p-4 ">
    <x-search :route="['/admin/courses']" />

    <div class="content-container p-4 ">
        <div class="!flex justify-between items-center px-4 py-2 text-lg font-bold">
            <span>Title</span>
            <span>Action</span>
        </div>

        @if(count($courses) === 0)
        <p>No course found.</p>
        @endif

        @foreach($courses as $course)
        <div class="!flex justify-between border-b py-2">
            <span class="text-lg">{{$course->title}}</span>
            <a href="courses/{{$course->id}}">
                <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded">View</button>
            </a>
        </div>
        @endforeach
    </div>

    <div>
        {{$courses->links('pagination::bootstrap-5')}}
    </div>
</div>

<iframe
 frameBorder="0"
 height="450px"  
 src="https://onecompiler.com/embed/html" 
 width="100%"
 ></iframe>

@stop