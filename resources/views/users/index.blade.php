@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        
        <div class="w-full md:w-8/12 bg-white m-6 p-6 rounded-lg">
            @foreach ($users as $user)
            <div class="mb-4">
                <div class="flex justify-start items-center flex-wrap">
                    <p class="mr-4">{{ $user->name }}</p>
                    <p class="text-gray-600 text-sm">{{ $user->is_admin ? "Es administrador" : "" }}</p>
                </div>
                <div class="flex justify-between flex-wrap">
                    <p class="italic mr-4">{{ $user->email }}</p>
                    <div class="flex items-baseline">
                        <a href="" class="text-blue-500 text-sm mr-6">Editar</a>
                        <form action="" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-400 text-sm">Eliminar</button>
                            <!-- <button type="submit" class="text-red-500">Eliminar</button> -->
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            {{ $users->links() }}
        </div>

        <a class="fixed right-8 bottom-8 sm:right-16 sm:bottom-16 rounded-full bg-blue-500 p-2" href="{{ route('users.create') }}">
            <svg class="inline text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </a>

    </div>
@endsection