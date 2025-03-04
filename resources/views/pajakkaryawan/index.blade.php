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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                @include('pajakkaryawan.partials.modal-form-add-pajak-karyawan')
                <table class="table table-striped table-bordered" id="pajakKaryawanTable">
                    <div class="mb-3">
                        <label for="filterPerusahaan" class="form-label">Filter Perusahaan:</label>
                        <select id="filterPerusahaan" class="form-control">
                            <option value="">Semua Perusahaan</option>
                            @foreach ($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id_perusahaan }}">{{ $perusahaan->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>NPWP</th>
                            <th>Alamat</th>
                            <th>Perusahaan</th>
                            <th>Penghasilan</th>
                            <th>Status Pajak</th>
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
            $('#npwp').inputmask({ mask: "99.999.999.9-999.999" });

            let table = $('#pajakKaryawanTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: "{{ route('pajak-karyawan.index') }}",
                    data: function(d) {
                        d.perusahaan_id = $('#filterPerusahaan').val(); // Kirim ID perusahaan ke server
                    }
                },
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy text-secondary"></i>',
                        titleAttr: 'Copy',
                        title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan\nPajak Karyawan',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv text-warning"></i>',
                        titleAttr: 'Export CSV',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Pajak_Karyawan',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel text-success"></i>',
                        titleAttr: 'Export Excel',
                        title: 'Kantor_Konsultan_Pajak_Suwandi_Sudarsono_&_Rekan - Pajak_Karyawan',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf text-danger"></i>',
                        titleAttr: 'Export PDF',
                        title: 'Kantor Konsultan Pajak Suwandi Sudarsono & Rekan',
                        messageTop: 'Pajak Karyawan',
                        exportOptions: { columns: ':not(:last-child)' },
                        className: 'btn btn-light'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print text-primary"></i>',
                        titleAttr: 'Print',
                        title: 'Pajak Karyawan',
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
                    { data: 'nama_karyawan', name: 'nama_karyawan' },
                    { data: 'npwp', name: 'npwp' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'perusahaan.nama_perusahaan', name: 'perusahaan.nama_perusahaan' },
                    { data: 'penghasilan', name: 'penghasilan', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')},
                    { data: 'status_pajak', name: 'status_pajak' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Event ketika filter diubah
            $('#filterPerusahaan').change(function() {
                table.ajax.reload(); // Reload DataTables dengan filter baru
            });
        });
    </script>
    @endpush
</x-app-layout>
