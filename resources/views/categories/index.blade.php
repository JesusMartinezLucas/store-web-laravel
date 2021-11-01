@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        
        <div class="w-full sm:w-8/12 md:w-7/12 lg:w-6/12 xl:w-5/12 2xl:w-4/12 bg-white m-6 p-6 rounded-lg">
            @foreach ($categories as $category)
            <div class="mb-4">
                <div class="flex justify-between flex-wrap">
                    <p class="mr-4">{{ $category->name }}</p>
                    @if (auth()->user()->is_admin)
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                class="text-red-400" 
                                onclick="return confirm('¿Estás seguro de eliminar la categoría?')"
                            >
                                Eliminar
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach

            {{ $categories->links() }}
        </div>

        <a class="fixed right-8 bottom-8 sm:right-16 sm:bottom-16 rounded-full bg-blue-500 p-2" href="{{ route('categories.create') }}">
            <x-icons.plus />
        </a>

    </div>
@endsection