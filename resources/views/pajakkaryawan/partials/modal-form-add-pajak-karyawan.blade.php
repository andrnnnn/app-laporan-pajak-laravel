<div x-data="{ show: false }">
    <button @click="show = true" class="btn btn-primary mb-3">Tambah Pajak Karyawan</button>

    <!-- Modal -->
    <div x-show="show" x-on:keydown.escape.window="show = false" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
        <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div x-show="show" class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto">
            <form method="POST" action="{{ route('pajak-karyawan.store') }}">
                @csrf
                <div class="p-6">
                    <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah Pajak Karyawan</h3>

                    <!-- Nama Perusahaan -->
                    <div class="mt-4">
                        <label for="id_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                        <select name="id_perusahaan" id="id_perusahaan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}">{{ $perusahaan->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- NPWP -->
                    <div class="mt-4">
                        <label for="npwp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NPWP</label>
                        <input type="text" name="npwp" id="npwp"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                               placeholder="XX.XXX.XXX.X-XXX.XXX" required>
                    </div>

                    <!-- Nama Karyawan -->
                    <div class="mt-4">
                        <label for="nama_karyawan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Karyawan</label>
                        <input type="text" name="nama_karyawan" id="nama_karyawan"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                               placeholder="Nama Lengkap" required>
                    </div>

                    <!-- Alamat -->
                    <div class="mt-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                        <textarea name="alamat" id="alamat"
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                  placeholder="Jl. XXX No. XX, Kota XXX" rows="3" required></textarea>
                    </div>

                    <!-- Penghasilan -->
                    <div class="mt-4">
                        <label for="penghasilan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penghasilan</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600 dark:text-gray-400">Rp</span>
                            <input type="text" id="penghasilan_format"
                                   class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                   placeholder="0" required oninput="formatRupiah(this)">
                            <input type="hidden" name="penghasilan" id="penghasilan">
                        </div>
                    </div>

                    <!-- Status Pajak -->
                    <div class="mt-4">
                        <label for="status_pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Pajak</label>
                        <select name="status_pajak" id="status_pajak"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                required>
                            <option value="Wajib Pajak">Wajib Pajak</option>
                            <option value="Tidak Wajib Pajak">Tidak Wajib Pajak</option>
                        </select>
                    </div>

                    <!-- Tombol Simpan & Batal -->
                    <div class="mt-4 flex justify-end">
                        <button type="button" x-on:click="show = false" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Format Rupiah -->
<script>
    function formatRupiah(element) {
        let value = element.value.replace(/\D/g, ""); // Hanya angka
        let formatted = new Intl.NumberFormat("id-ID").format(value); // Format ribuan
        element.value = formatted;

        // Simpan nilai asli (tanpa format) ke input hidden untuk dikirim ke database
        document.getElementById("penghasilan").value = value;
    }
</script>
