<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>
    <h1>
        @auth
        <strong>Hello {{auth()->user()->name}}!</strong> Welcome to the Home Page. {{auth()->user()->role_id}}
        @else
         Hello from the Home Page.
        @endauth
    </h1>
</x-layout>
