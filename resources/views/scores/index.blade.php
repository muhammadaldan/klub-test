@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Formulir pertandingan akan ditambahkan di sini -->
    <form id="scoreForm">
        <div id="matchesContainer" class="mb-4">
            <!-- Contoh pertandingan -->
            <div class="flex items-center mb-3">
                <div class="mr-4">
                    <select name="klub1_1" class="p-2 border rounded-md w-64" required>
                        <option value="">Pilih Klub 1</option>
                        @foreach ($clubs as $club)
                        <option value="{{ $club->id }}">{{ $club->nama_klub }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-4">
                    <input type="number" name="score1_1" class="p-2 border rounded-md w-16" placeholder="Skor 1"
                        required>
                </div>
                <div class="mr-4">
                    <span>-</span>
                </div>
                <div class="mr-4">
                    <input type="number" name="score2_1" class="p-2 border rounded-md w-16" placeholder="Skor 2"
                        required>
                </div>
                <div>
                    <select name="klub2_1" class="p-2 border rounded-md w-64" required>
                        <option value="">Pilih Klub 2</option>
                        @foreach ($clubs as $club)
                        <option value="{{ $club->id }}">{{ $club->nama_klub }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="button" onclick="addMatch()"
                class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Tambah Pertandingan</button>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let matchCount = 1;

    function addMatch() {
        matchCount++;
        const matchesContainer = document.getElementById('matchesContainer');

        const matchDiv = document.createElement('div');
        matchDiv.classList.add('mb-3');

        matchDiv.innerHTML = `
            <div class="flex items-center mt-3">
                <div class="mr-4">
                    <select name="klub1_${matchCount}" class="p-2 border rounded-md w-64" required>
                        <option value="">Pilih Klub 1</option>
                        @foreach ($clubs as $club)
                        <option value="{{ $club->id }}">{{ $club->nama_klub }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-4">
                    <input type="number" name="score1_${matchCount}" class="p-2 border rounded-md w-16" placeholder="Skor 1" required>
                </div>
                <div class="mr-4">
                    <span>-</span>
                </div>
                <div class="mr-4">
                    <input type="number" name="score2_${matchCount}" class="p-2 border rounded-md w-16" placeholder="Skor 2" required>
                </div>
                <div>
                    <select name="klub2_${matchCount}" class="p-2 border rounded-md w-64" required>
                        <option value="">Pilih Klub 2</option>
                        @foreach ($clubs as $club)
                        <option value="{{ $club->id }}">{{ $club->nama_klub }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        `;

        matchesContainer.appendChild(matchDiv);
    }

    const scoreForm = document.getElementById('scoreForm');

    scoreForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const klub1Values = document.querySelectorAll('select[name^="klub1_"]');
        const klub2Values = document.querySelectorAll('select[name^="klub2_"]');
        let isDuplicate = false;

        klub1Values.forEach((klub1, index) => {
            const klub2 = klub2Values[index];

            if (klub1.value === klub2.value) {
                isDuplicate = true;

                // Tambahkan kelas border-red-500 pada input klub yang sama
                klub1.classList.add('border', 'border-red-500');
                klub2.classList.add('border', 'border-red-500');
            } else {
                // Hapus kelas border-red-500 jika input klub berbeda
                klub1.classList.remove('border', 'border-red-500');
                klub2.classList.remove('border', 'border-red-500');
            }
        });

        if (isDuplicate) {
            Swal.fire({
                icon: 'error',
                title: 'Data pertandingan tidak valid',
                text: 'Terdapat pertandingan dengan klub yang sama',
            });
            return;
        }

        const formData = new FormData(scoreForm);
        const matches = [];

        for (const pair of formData.entries()) {
            if (pair[0].startsWith('klub1_')) {
                const matchIndex = pair[0].split('_')[1];
                const klub1 = pair[1];
                const klub2 = formData.get(`klub2_${matchIndex}`);
                const score1 = formData.get(`score1_${matchIndex}`);
                const score2 = formData.get(`score2_${matchIndex}`);

                matches.push({
                    klub1,
                    klub2,
                    score1,
                    score2,
                });
            }
        }

        axios.post('/scores', {
                matches: matches,
            })
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Data pertandingan berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1500
                });

                scoreForm.reset();
                document.querySelectorAll('.border-red-500').forEach(input => {
                    input.classList.remove('border-red-500');
                });
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Data pertandingan yang sama sudah ada.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data pertandingan.',
                    });
                }
            });
    });

</script>
@endsection
