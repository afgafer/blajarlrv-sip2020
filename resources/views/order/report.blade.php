@extends('layouts.app')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="bg-white p-2">
@if (Session::get('message'))
@php
$message = Session::get('message');
@endphp
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
@php
if(isset($_GET['date1']) and isset($_GET['date2'])){
    $date1=$_GET['date1'];
    $date2=$_GET['date2'];
}else{
    $date1=date("Y-m-01");
    $date2=date("Y-m-t");
}
@endphp
<form action="{{route('order.report')}}" method="GET">
<div class="form-row">
        <div class="col-md-3">
            <label for="date1">date1</label>
            <input type="date" id="date1" value='{{$date1}}' class="form-control" name="date1">
        </div>
        <div class="col-md-3">
            <label for="date2">date2</label>
            <input type="date" id="date2" value='{{$date2}}' class="form-control" name="date2">
        </div>
        <div class="col-1">
            <button id="filter" class="btn btn-primary">filter</button>
        </div>
</div>
</form>
<!-- <div class="form-row mb-3">
        <div class="col-md-3">
            <input type="text" id="search" class="form-control bg-transparent" style="border-bottom: 1px solid dodgerblue" placeholder="name customer/room">
        </div>
</div> -->
<div class="scroll">
        <table class="table table-sm bg-limpid-light" id="example">
            <thead>
                <tr class='bg-primary text-white'>
                    <th>No</th>
                    <th>name</th>
                    <th>cin</th>
                    <th>count</th>
                    <th>bill</th>
                </tr>
                <tbody id="tBody">
                </tbody>
                <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
            </thead>
        </table>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
    
    $(document).ready(function() {

        var printCounter = 0;
    
        $('#example').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
        
        status="order";
        date1=$('#date1').val();
        date2=$('#date2').val();
        console.log(date1);
        url="{{route('order.filter')}}?date1="+date1+"&date2="+date2+"&status="+status;
        console.log(date2);
        $('#example').DataTable( {
            ajax: url,
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'cin' },
                { data: 'count' },
                { data: 'bill' },
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                },
                {
                    extend: 'pdf',
                    messageBottom: null
                },
                {
                    extend: 'print',
                    messageTop: function () {
                        printCounter++;
    
                        if ( printCounter === 1 ) {
                            return 'This is the first time you have printed this document.';
                        }
                        else {
                            return 'You have printed this document '+printCounter+' times';
                        }
                    },
                    messageBottom: null
                }
            ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }
    } );
    });
    </script>
</div>
@endsection