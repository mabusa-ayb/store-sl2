<table class="table table-bordered dataTable-history" cellspacing="0" style="width: 100%" id="table-media">
    <thead>
    <tr>
        <td>Date</td>
        <td>Invoice Number</td>
        <td>Purchase Price</td>
    </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ date('d-m-Y', strtotime($data->purchase->date)) }}</td>
                <td>{{ $data->purchase->num_invoice }}</td>
                <td>{{ number_format($data->price,0,'.',',') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- page script -->
