@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white m-6 p-6 rounded-lg">
        <x-product :product="$product" />
    </div>
</div>
@endsection