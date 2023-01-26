@extends('layouts.app')

@push('custom_css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
@endpush

@section('content')

    <div class="container">

        <x-breadcrumb model="Blog"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                <table class="table" id="datatable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        @foreach ($columns as $column)
                            <th>{{ ucfirst($column) }}</th>
                        @endforeach
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>

@endsection

@push('custom_js')

    @include('_custom_includes.swal-delete')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            $.fn.dataTable.ext.errMode = 'throw';


            $('#datatable').DataTable({

                dom: 'Bfrtip',
                /* buttons: [
                     'csv', 'excel', 'pdf', 'print'
                 ],*/

                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                ],

                data: {
                    "_token": "{{ csrf_token() }}"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('blogs.datatable') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        @foreach ($columns as $column)
                    {
                        data: '{{ $column }}', name: '{{ $column }}'
                    },
                        @endforeach
                    {
                        data: 'action', name: 'action', orderable: false, searchable: false
                    },
                ],
                exportOptions: {
                    columns: [0, 1, 2]
                }
            });
        });
    </script>

@endpush