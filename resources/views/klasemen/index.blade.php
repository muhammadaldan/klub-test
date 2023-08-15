<!-- resources/views/scores/klasemen.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Klasemen</h2>
    <a href="{{ route('clubs.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 mr-4">
        Tambah Klub Baru
    </a>
    <a href="{{ route('scores.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4">
        Tambah Score
    </a>
    <table class="w-full border-collapse border mt-4">
        <thead>
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">Klub</th>
                <th class="border p-2">Ma</th>
                <th class="border p-2">Me</th>
                <th class="border p-2">S</th>
                <th class="border p-2">K</th>
                <th class="border p-2">GM</th>
                <th class="border p-2">GK</th>
                <th class="border p-2">Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clubs as $index => $club)
            <tr>
                <td class="border p-2">{{ $index + 1 }}</td>
                <td class="border p-2">{{ $club->nama_klub }}</td>
                <td class="border p-2">{{ $club->main }}</td>
                <td class="border p-2">{{ $club->menang }}</td>
                <td class="border p-2">{{ $club->seri }}</td>
                <td class="border p-2">{{ $club->kalah }}</td>
                <td class="border p-2">{{ $club->goal_menang }}</td>
                <td class="border p-2">{{ $club->goal_menang }}</td>
                <td class="border p-2">{{ $club->point }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
