<!-- admin.absensi.create.blade.php -->
@extends('layouts/main')

@section('container')
    <div class="w-full h-screen bg-myBg flex items-center">

        <div class="tablet:hidden">
        @include('/layouts/mahasiswaNav')
    </div>

        <div class="w-1/2 desktop:w-full flex flex-col mx-auto bg-medium rounded-3xl p-20 tablet:p-8 shadow-3xl">


            <div class=" bg-primary p-5 flex text-white items-center rounded-3xl shadow-3xl">



                <a href="/mahasiswa/jurnal"
                    class="flex items-center justify-center w-20 h-20 tablet:w-10 tablet:h-10 bg-white text-primary text-4xl tablet:text-2xl rounded-full hover-white ">
                    <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                </a>

                <div class="ml-12">
                    <h1 class="text-3xl tablet:text-xl font-bold">{{$title}}</h1>
                </div>


            </div>

            <form action="/mahasiswa/jurnal" method="post" class="flex flex-col w-full text-white mt-10  mx-auto">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex items-center relative mb-10"
                        role="alert">
                        <ul class="list-disc ml-5 mb-0 flex-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="ml-4 text-xl font-semibold cursor-pointer"
                            onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                @endif



                <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->nim_nisn }}">


                <label for="kegiatan" class="mb-2">Kegiatan :</label>
                <textarea name="kegiatan" id="kegiatan" placeholder="Apa kegiatan anda hari ini ?"
                    class="text-slate-800 mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary"></textarea>

                <label for="tanggal" class="block text-sm font-medium ">Tanggal :</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ now()->format('Y-m-d') }}"
                    class="mt-1 p-2 border text-slate-800 rounded-md w-full">


                <input type="hidden" name="hari" id="hari"
                    class=" text-slate-800 mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary"
                    required>


                <button type="submit"
                    class="text-xl font-bold mt-10 bg-primary text-white px-6 py-3 rounded-md focus:outline-none hover-primary">Absen</button>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil tanggal dari elemen dengan id "tanggal"
            var tanggalInput = document.getElementById('tanggal');

            // Hitung nama hari dari tanggal hari ini
            var hari = new Date().toLocaleDateString('id-ID', {
                weekday: 'long'
            });

            // Set nilai input hidden "hari" dengan hari ini
            document.getElementById('hari').value = hari;

            // Tambahkan event listener untuk memperbarui input hidden jika tanggal berubah
            tanggalInput.addEventListener('change', function() {
                var tanggal = this.value;

                // Hitung nama hari dari tanggal yang dipilih
                var hari = new Date(tanggal).toLocaleDateString('id-ID', {
                    weekday: 'long'
                });

                // Isi nilai input hidden "hari"
                document.getElementById('hari').value = hari;
            });
        });
    </script>
@endsection
