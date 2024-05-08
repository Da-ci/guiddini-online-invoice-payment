@extends('components.master')
@section('content')
<div class="w-screen h-screen bg-guiddini-darkblue">
    <div class="flex justify-center items-center h-screen">
        <div class="block max-w-sm p-12 bg-white rounded-lg shadow text-white" style="background-color: #36236c">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Account suspended</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Your account has been suspended. You can no longer use the features of this solution until your account gets activated again.</p>
            @livewire('logout')
        </div>
    </div>
</div>
@endsection