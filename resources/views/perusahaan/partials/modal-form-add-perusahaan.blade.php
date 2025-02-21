<div x-data="{ show: false }">
    <button @click="show = true" class="btn btn-primary mb-3">Tambah Perusahaan</button>

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

        <form method="POST" action="{{ route('perusahaan.store') }}">
            @csrf
            <div class="p-6">
                <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah Perusahaan</h3>

                <!-- Form Fields -->
                <div class="mt-4">
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="PT XXX Sejahtera" required>
                </div>

                <div class="mt-4">
                    <label for="npwp_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NPWP Perusahaan</label>
                    <input type="text" name="npwp_perusahaan" id="npwp_perusahaan"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="XX.XXX.XXX.X-XXX.XXX" required>
                </div>

                <div class="mt-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                    <textarea name="alamat" id="alamat"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                              placeholder="Jl. XXX No. XX, Kota XXX" rows="3" required></textarea>
                </div>

                <div class="mt-4">
                    <label for="kontak" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kontak</label>
                    <input type="text" name="kontak" id="kontak"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="08XX-XXXX-XXXX atau 021-XXXX-XXXX" required>
                </div>

                <div class="mt-4">
                    <label for="jenis_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Usaha</label>
                    <input type="text" name="jenis_usaha" id="jenis_usaha"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                           placeholder="Perdagangan, Jasa XXX, Manufaktur" required>
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
