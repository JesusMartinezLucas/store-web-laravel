<form action="{{ $route }}" method="GET" id="searchForm" class="mr-2">
    <label for="search" class="sr-only">Buscar</label>
    <input type="text" name="search" id="searchInput" placeholder="Buscar ..."
    class="bg-gray-100 border-2 w-full px-4 py-2 rounded-lg @error('search')
    border-red-500 @enderror" value="{{ old('search', $search) }}">

    @error('search')
        <div class="text-red-500 mt-2 text-sm">
            {{$message}}
        </div>
    @enderror
</form>