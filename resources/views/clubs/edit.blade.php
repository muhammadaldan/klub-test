<!-- resources/views/clubs/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Edit Klub</h1>
    <form action="{{ route('clubs.update', $club->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama_klub" class="block text-gray-700 text-sm font-bold mb-2">Nama Klub:</label>
            <input type="text" name="nama_klub" id="nama_klub" class="border rounded w-full py-2 px-3" value="{{ $club->nama_klub }}" required>
        </div>
        <div class="mb-4">
            <label for="kota_klub" class="block text-gray-700 text-sm font-bold mb-2">Kota Klub:</label>
            <input type="text" name="kota_klub" id="kota_klub" class="border rounded w-full py-2 px-3" value="{{ $club->kota_klub }}" required>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
