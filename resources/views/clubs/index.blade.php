<!-- resources/views/clubs/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Daftar Klub Sepak Bola</h1>
    <a href="{{ route('clubs.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4">
        Tambah Klub Baru
    </a>
    @if ($clubs->isEmpty())
        <p>Belum ada klub yang terdaftar.</p>
    @else
        <table class="w-full border mt-5">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama Klub</th>
                    <th class="border px-4 py-2">Kota Klub</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clubs as $club)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $club->nama_klub }}</td>
                        <td class="border px-4 py-2">{{ $club->kota_klub }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('clubs.edit', $club->id) }}" class="bg-blue-500 text-white py-2 px-3 rounded hover:bg-blue-600 mr-3">
                                Edit
                            </a>
                            <form action="{{ route('clubs.destroy', $club->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600"">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
