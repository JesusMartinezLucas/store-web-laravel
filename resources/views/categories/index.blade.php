@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        
        <div class="w-full md:w-8/12 bg-white m-6 p-6 rounded-lg">
            Categorías
        </div>

        <a class="fixed right-8 bottom-8 sm:right-16 sm:bottom-16 rounded-full bg-blue-500 p-2" href="{{ route('categories.create') }}">
            <svg class="inline text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </a>

    </div>
@endsection