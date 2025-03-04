<div x-data="{ show: false }">
    <button @click="show = true" class="btn btn-primary mb-3">Tambah Laporan Pajak</button>

    <!-- Modal -->
    <div
        x-show="show"
        x-on:keydown.escape.window="show = false"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
        style="display: none;"
    >
        <div
            x-show="show"
            class="fixed inset-0 transform transition-all"
            x-on:click="show = false"
        >
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div
            x-show="show"
            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"
        >

        <form method="POST" action="{{ route('lapor-pajak.store') }}">
            @csrf
            <div class="p-6">
                <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah Laporan Pajak</h3>

                <!-- Pilih Karyawan -->
                <div class="mt-4">
                    <label for="id_karyawan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Karyawan</label>
                    <select name="id_karyawan" id="id_karyawan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($karyawan as $item)
                            <option value="{{ $item->id_karyawan }}">{{ $item->nama_karyawan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Jenis Pajak -->
                <div class="mt-4">
                    <label for="id_jenis_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pajak</label>
                    <select name="id_jenis_pajak" id="id_jenis_pajak"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            required>
                        <option value="">-- Pilih Jenis Pajak --</option>
                        @foreach($jenisPajak as $item)
                            <option value="{{ $item->id_jenis_pajak }}">{{ $item->kode_pajak }} - {{ $item->nama_pajak }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Bulan Pajak -->
                <div class="mt-4">
                    <label for="bulan_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bulan Pajak</label>
                    <select name="bulan_pajak" id="bulan_pajak"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            required>
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(range(1, 12) as $bulan)
                            <option value="{{ $bulan }}">{{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Tahun Pajak -->
                <div class="mt-4">
                    <label for="tahun_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Pajak</label>
                    <select name="tahun_pajak" id="tahun_pajak"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            required>
                        <option value="">-- Pilih Tahun --</option>
                        @foreach(range(date('Y') - 5, date('Y') + 1) as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="button" x-on:click="show = false" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
