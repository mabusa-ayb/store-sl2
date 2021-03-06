<div style="overflow:auto;">
    <table class="table table-bordered dataTable-purchase-product" cellspacing="0" style="width: 100%" id="table-media">
        <thead>
        <tr>
            <td>ID</td>
            <td>Code</td>
            <td>Name</td>
            <td>Stock Available</td>
            <td>Stock Total</td>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>

<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- page script -->

<script>
    $('#table-media').on('click', 'tbody tr', function (e) {
        e.preventDefault();

        $('#id_raw_product_1').val($(this).find('td').html());
        $('#name_raw_product_1').val($(this).find('td').next().next().html());
    });

    $('.dataTable-purchase-product').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{route('browse-product/datatable')}}",
        columns:[
            {data:'id', name:'id'},
            {data:'code', name:'code'},
            {data:'name', name:'name'},
            {data:'stock_available', name:'stock_available'},
            {data:'stock_total', name:'stock_total'},
        ],
        responsive:true
    });

    $('#table-media').on('click', 'tbody tr', function(e){
        $('#modal-default').modal('hide');
    })
</script>
