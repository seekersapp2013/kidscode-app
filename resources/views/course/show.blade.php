@extends('voyager::master')

@section('content')

<div>
    <p>Course title: {{$course->title}}</p>
    <p>Course description: {{$course->description}}</p>
    <p>Course tag: {{$course->tags}}</p>
    <p>Course points: {{$course->points}}</p>
    <p>Course duration: {{$course->duration}}</p>
</div>

<div class="!flex justify-between w-36">
    <a href="/admin/courses/{{$course->id}}/edit">
        <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">Edit</button>
    </a>

    <form method="POST" action="/admin/courses/{{$course->id}}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete" class="bg-red-500 hover:bg-blue-500 text-white font-bold py-1 px-2 rounded">
    </form>
</div>

<div>
    <h3>Chapters</h3>
    <div class="p-4 ">

        <div class="!flex justify-between items-center py-2 text-lg font-bold">
            <span>Chapter number</span>
            <div class="!flex justify-between w-3/4">
                <span>Title</span>
                <span>Action</span>
            </div>
        </div>

        @if(count($chapters) === 0)
        <p>This book currently has no chapters.</p>
        @endif

        @foreach($chapters as $chapter)
        <div class="!flex justify-between border-b py-2">
            <span style="margin-right: 100px;">Chapter {{$chapter['chapter_number']}}</span>
            <div class="!flex justify-between w-3/4">
                <span style="margin-right: 100px;">{{$chapter['title']}}</span>
                @if($chapter['hasAccess'])
                <a href="/admin/courses/{{$course->id}}/chapters/view?chapter_number={{$chapter['chapter_number']}}">
                    <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">View</button>
                </a>
                @else
                <a href="/admin/courses/{{$course->id}}/chapters/pay?chapter_number={{$chapter['chapter_number']}}&coins_needed={{$chapter['coins_needed']}}">
                    <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">Pay to view</button>
                </a>
                @endif

                <a href="/admin/courses/{{$course->id}}/chapters/edit?chapter_number={{$chapter['chapter_number']}}">
                    <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">Edit</button>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <a href="/admin/courses/{{$course->id}}/chapters/create">
        <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">Add new chapter</button>
    </a>
</div>
@stop