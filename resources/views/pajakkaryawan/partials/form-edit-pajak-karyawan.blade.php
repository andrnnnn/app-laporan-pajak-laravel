@push('styles')
@include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pajak Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Edit Pajak Karyawan</h3>

                <form method="POST" action="{{ route('pajak-karyawan.update', $pajakKaryawan->id_karyawan) }}">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <label for="id_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                        <select name="id_perusahaan" id="id_perusahaan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                            <option value="">-- Pilih Perusahaan --</option>
                            @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}" {{ $pajakKaryawan->id_perusahaan == $perusahaan->id_perusahaan ? 'selected' : '' }}>
                                    {{ $perusahaan->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mt-4">
                        <label for="nama_karyawan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Karyawan</label>
                        <input type="text" name="nama_karyawan" id="nama_karyawan" value="{{ $pajakKaryawan->nama_karyawan }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                    </div>

                    <div class="mt-4">
                        <label for="npwp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NPWP</label>
                        <input type="text" name="npwp" id="npwp" value="{{ $pajakKaryawan->npwp }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                    </div>

                    <div class="mt-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                        <textarea name="alamat" id="alamat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" rows="3" required>{{ $pajakKaryawan->alamat }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label for="penghasilan_display" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penghasilan</label>

                        <input type="text" id="penghasilan_display" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-right" required>

                        <input type="hidden" name="penghasilan" id="penghasilan" value="{{ $pajakKaryawan->penghasilan }}">
                    </div>

                    <div class="mt-4">
                        <label for="status_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Pajak</label>
                        <select name="status_pajak" id="status_pajak" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                            <option value="Wajib Pajak" {{ $pajakKaryawan->status_pajak == 'Wajib Pajak' ? 'selected' : '' }}>Wajib Pajak</option>
                            <option value="Tidak Wajib Pajak" {{ $pajakKaryawan->status_pajak == 'Tidak Wajib Pajak' ? 'selected' : '' }}>Tidak Wajib Pajak</option>
                        </select>
                    </div>

                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('pajak-karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary ml-3">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    @include('layouts.includes.script')

    <script>
        $(document).ready(function() {
            $('#npwp').inputmask({ mask: "99.999.999.9-999.999" });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const penghasilanDisplay = document.getElementById("penghasilan_display");
            const penghasilanHidden = document.getElementById("penghasilan");

            if (!penghasilanDisplay || !penghasilanHidden) return; // Cegah error jika elemen tidak ditemukan

            function formatRupiah(value) {
                if (value === null || value === undefined) return "Rp 0"; // Cegah error jika value kosong
                let angka = parseFloat(value.toString().replace(/[^0-9]/g, "")) || 0; // Pastikan angka valid
                return "Rp " + angka.toLocaleString("id-ID"); // Format ke Rupiah
            }

            function updateInput() {
                let rawValue = penghasilanDisplay.value.replace(/[^0-9]/g, ""); // Ambil angka saja
                penghasilanDisplay.value = formatRupiah(rawValue); // Format dengan "Rp "
                penghasilanHidden.value = rawValue; // Simpan angka asli untuk database (tanpa "Rp" atau titik)
            }

            // Event listener untuk input (real-time update saat mengetik)
            penghasilanDisplay.addEventListener("input", updateInput);
            penghasilanDisplay.addEventListener("change", updateInput); // Pastikan tetap terformat saat keluar dari input

            // **🛠 Set nilai awal dari database dengan perbaikan**
            if (penghasilanHidden.value.trim() !== "") {
                let nilaiAsli = parseFloat(penghasilanHidden.value.replace(/,/g, "")) || 0;
                penghasilanDisplay.value = formatRupiah(nilaiAsli);
            }
        });
    </script>

    @endpush
</x-app-layout>
