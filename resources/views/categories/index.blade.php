@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        
        <div class="w-full sm:w-8/12 md:w-7/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 bg-white m-6 p-6 rounded-lg">
            @foreach ($categories as $category)
            <div class="mb-4">
                <div class="flex justify-between flex-wrap">
                    <p class="mr-4">{{ $category->name }}</p>
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- type="submit"  -->
                        <button 
                            type="button" 
                            class="text-red-400" 
                            onclick="return confirm('¿Estás seguro de eliminar la categoría?')"
                        >
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            {{ $categories->links() }}
        </div>

        <a class="fixed right-8 bottom-8 sm:right-16 sm:bottom-16 rounded-full bg-blue-500 p-2" href="{{ route('categories.create') }}">
            <svg class="inline text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </a>

    </div>
@endsection