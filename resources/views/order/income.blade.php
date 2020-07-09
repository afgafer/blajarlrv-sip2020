@extends('layouts.app')

@section('content')
<h1 class="title">Order</h1>

<div id="msg">
    @if (Session::get('message'))
    @php
    $message = Session::get('message');
    @endphp
    <div class="alert alert-success martop-sm">
        <p>{{ $message }}</p>
    </div>
    @endif
</div>

@php
$date1=date("Y-m-01");
$date2=date("Y-m-t");
@endphp
<!-- form -->
<div class="form-row">
    <div class="col-md-3">
        <label for="date1">start date :</label>
        <input type="date" id="date1" value='{{$date1}}' class="form-control">
    </div>
    <div class="col-md-3">
        <label for="date2">end date :</label>
        <input type="date" id="date2" value='{{$date2}}' class="form-control">
    </div>
    <div class="col-1 align-self-end">
        <button id="filter" class="btn btn-primary">filter</button>
    </div>
</div>
<div class="form-row my-3">
    <div class="col-md-3">
        <input type="text" id="search" class="form-control bg-transparent" style="border-bottom: 1px solid dodgerblue"
            placeholder="name invoice/customer/room">
    </div>
</div>
<!--end form -->
<div class="scroll" style="width:80vw;">
    <table class="table table-sm">
        <thead>
            <tr class='bg-dark text-white'>
                <th>No</th>
                <th>name</th>
                <th>check in</th>
                <th>qty</th>
                <th class="text-right">bill</th>
                <th class="text-center">status</th>
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
        </tr>
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        function fetch(query = '') {
            status = '3';
            query = $('#search').val();
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            $.ajax({
                url: "{{route('order.count')}}",
                method: 'GET',
                data: { query: query, date1: date1, date2: date2, status: status },
                dataType: 'json',
                success: function (data) {
                    $('#tBody').html(data.tableData);
                }
            });
        }
        $("#date1").blur(function () {
            date1 = $('#date1').val();
            $('#date2').attr("min", date1);
        });
        fetch();
        $(document).on('click', '#filter', function () {
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            if (date2 > date1) {
                $('#msg').html("")
                fetch();
            } else {
                $('#msg').html("<div class='alert alert-danger martop-sm' >Input failed, end date bigest then start date</div>")
            }
        });
        $(document).on('keyup', '#search', function () {
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            query = $(this).val();
            if (date1 < date2) {
                $('#msg').html("")
                fetch(query);
            } else {
                $('#msg').html("<div class='alert alert-danger martop-sm' >Input failed, end date bigest then start date</div>")
            }
        });
    });
</script>
@endsection