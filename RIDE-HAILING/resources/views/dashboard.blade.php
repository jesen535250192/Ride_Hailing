<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard Ride Hailing</h2>
    </x-slot>

    <div style="padding: 30px;">
        <h3>Selamat datang, {{ auth()->user()->name }}</h3>

        <br>

        <a href="{{ route('order.create') }}">
            <button>Pesan Ride</button>
        </a>
    
    </div>
</x-app-layout>