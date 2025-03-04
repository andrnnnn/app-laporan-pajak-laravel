@push('styles')
@include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                @include('laporpajak.partials.modal-form-add-lapor-pajak')
                <table class="table table-striped table-bordered" id="laporPajakTable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Jenis Pajak</th>
                            <th>Bulan Pajak</th>
                            <th>Tahun Pajak</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Potongan</th>
                            <th>Penghasilan Bersih</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    @include('layouts.includes.script')

    <script>
        $(document).ready(function() {
            let table = $('#laporPajakTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('lapor-pajak.index') }}",
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy text-secondary"></i>',
                        titleAttr: 'Copy',
                        title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan\nLaporan Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv text-warning"></i>',
                        titleAttr: 'Export CSV',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Laporan_Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel text-success"></i>',
                        titleAttr: 'Export Excel',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Laporan_Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf text-danger"></i>',
                        titleAttr: 'Export PDF',
                        title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan',
                        messageTop: 'Laporan Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print text-primary"></i>',
                        titleAttr: 'Print',
                        title: 'Laporan Pajak',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    }
                ],
                initComplete: function(){
                    $('.dt-button').removeClass('dt-button');
                    $('.dt-buttons').addClass('mb-3 mt-3');
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'karyawan.nama_karyawan', name: 'karyawan.nama_karyawan' },
                    { data: 'jenis_pajak.kode_pajak', name: 'jenisPajak.kode_pajak' },
                    {
                        data: 'bulan_pajak',
                        name: 'bulan_pajak',
                        render: function(data, type, row) {
                            let monthNames = [
                                '', 'January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'
                            ];
                            return monthNames[data] || data;
                        }
                    },
                    { data: 'tahun_pajak', name: 'tahun_pajak' },
                    { data: 'tanggal_pembayaran', name: 'tanggal_pembayaran' },
                    { data: 'potongan', name: 'potongan', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ') },
                    { data: 'penghasilan_bersih', name: 'penghasilan_bersih', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ') },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Aktifkan Tooltip Bootstrap
            $('body').tooltip({ selector: '[titleAttr]' });
        });
    </script>
    @endpush
</x-app-layout>
