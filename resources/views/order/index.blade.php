@extends('layouts.app')

@section('content')
<!-- <button id="export" class="btn btn-primary">export</button> -->
@if (Session::get('message'))
@php
$message = Session::get('message');
@endphp
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
@php
//if(isset($_GET['date1']) and isset($_GET['date2'])){
    //$date1=$_GET['date1'];
    //$date2=$_GET['date2'];
//}else{
    $date1=date("Y-m-01");
    $date2=date("Y-m-t");
//}
@endphp
<div class="form-row">
        <div class="col-md-3">
            <label for="date1">start date</label>
            <input type="date" id="date1" value='{{$date1}}' class="form-control">
        </div>
        <div class="col-md-3">
            <label for="date2">end date</label>
            <input type="date" id="date2" value='{{$date2}}' class="form-control">
        </div>
        <div class="col-1 align-self-end">
            <button id="filter" class="btn btn-primary">filter</button>
        </div>
</div>
<div class="form-row my-3">
        <div class="col-md-3">
            <input type="text" id="search" class="form-control bg-transparent" style="border-bottom: 1px solid dodgerblue" placeholder="name invoice/customer/room">
        </div>
</div>
<div class="scroll"  style="width:80vw;">
        <table class="table table-sm">
            <thead>
                <tr class='bg-dark text-white'>
                    <th>invoice</th>
                    <th>name</th>
                    <th>check in</th>
                    <th>qty</th>
                    <th>bill</th>
                    <th>status</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody id="tBody">
            </tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    
    $(document).ready(function() {
        fetch();
            
        function fetch(query='') {
            status="{{$_GET['status']}}";
            query=$('#search').val();
            date1=$('#date1').val();
            date2=$('#date2').val();
            $.ajax({
                url:"{{route('order.search')}}",
                method:'GET',
                data:{query:query,date1:date1,date2:date2,status:status},
                dataType:'json',
                success: function(data){
                    $('#tBody').html(data.tableData);
                }
            });
        }

        $(document).on('click','#filter',function(){
                fetch();
        });
        $(document).on('click','#export',function(){
            status="{{$_GET['status']}}";
            date1=$('#date1').val();
            date2=$('#date2').val();
            url="https://afiqragroup.online/admin/order/export?date1="+date1+"&date2="+date2+"&status="+status;
            window.location = url;
        });
        $(document).on('keyup','#search',function(){
           var query=$(this).val();
           fetch(query);
        });
       
    });
    </script>
@endsection