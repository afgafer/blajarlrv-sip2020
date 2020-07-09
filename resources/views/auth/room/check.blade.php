@extends('layouts.app')
@section('content')
<!-- form -->
<div id="form">
    <h1 class="title">check</h1>
    <div id="msg"></div>
    <div class="form-row pl-3">
        <div class="form-group col-md-5">
            <label for="cin">check in :</label>
            <input type="date" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}" id="date1" class="form-control">
        </div>
        <div class="form-group col-md-5">
            <label for="cout">check out :</label>
            <input type="date" id="date2" class="form-control">
        </div>
        <div class="form-group col-md-1 align-self-center">
            <button class="btn btn-primary" id="filter">filter</button>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4">
            <input type="text" placeholder="search name hotel/room" id="search" class="form-control">
        </div>
    </div>
</div>
<!--end form -->
<p>
    <ul>
        Annotation :
        <li>Before check in has to make 100% paychecks </li>
        <li>Check in time on 14.00 WIB and Check out on time 12.00 WIB</li>
    </ul>
</p>
<h1 class="title text-center mt-2">rooms</h1>
<div class="card-columns" id="result">
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        function fetch(query = '') {
            query = $('#search').val();
            date1 = $('#date1').val();
            date2 = $('#date2').val();
            $.ajax({
                url: "{{route('room.search')}}",
                method: 'GET',
                data: { query: query, date1: date1, date2: date2 },
                dataType: 'json',
                success: function (data) {
                    $('#result').html(data.card_data);
                }
            });
        }
        $("#date1").blur(function () {
            date1 = $('#date1').val();
            $('#date2').attr("min", date1);
        });
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