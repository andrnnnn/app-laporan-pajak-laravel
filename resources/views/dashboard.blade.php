<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Laporan Pajak Bulan Ini</h3>
                    @if($total_laporan > 0)
                        <p class="text-4xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($total_laporan) }}</p>
                    @else
                        <p class="text-xl text-gray-500">Belum ada laporan pajak bulan ini</p>
                    @endif
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Perusahaan Dilaporkan</h3>
                    @if($total_perusahaan > 0)
                        <p class="text-4xl font-bold text-green-600 dark:text-green-400">{{ number_format($total_perusahaan) }}</p>
                    @else
                        <p class="text-xl text-gray-500">Belum ada perusahaan dilaporkan</p>
                    @endif
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Karyawan Dilaporkan</h3>
                    @if($total_karyawan > 0)
                        <p class="text-4xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($total_karyawan) }}</p>
                    @else
                        <p class="text-xl text-gray-500">Belum ada karyawan dilaporkan</p>
                    @endif
                </div>
            </div>

            <!-- Chart Jenis Pajak -->
            {{-- <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Distribusi Jenis Pajak</h3>
                <div id="chartContainer">
                    <canvas id="jenisPajakChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('jenisPajakChart').getContext('2d');
            const labels = {!! json_encode($jenis_pajak_labels) !!};
            const data = {!! json_encode($jenis_pajak_data) !!};

            if (data.length === 0) {
                document.getElementById('chartContainer').innerHTML = 
                    '<p class="text-center text-gray-500">Belum ada data pajak untuk ditampilkan</p>';
                return;
            }

            const colors = [
                '#3498db', '#e74c3c', '#2ecc71', '#f1c40f',
                '#9b59b6', '#34495e', '#16a085', '#f39c12',
                '#d35400', '#c0392b', '#7f8c8d', '#27ae60'
            ];

            const backgroundColors = colors.slice(0, labels.length);

            new Chart(ctx, {
                type: 'doughnut', 
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: data,
                        backgroundColor: backgroundColors
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script> --}}
</x-app-layout>
