@props(['route'])

<div class="!flex justify-end items-center">
    <form action="{{$route[0]}}">
        <input name="search" type="text" class="border py-1 py-2 w-96">
        <input type="submit" value="Search" class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">
    </form>
</div>