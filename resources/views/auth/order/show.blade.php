@extends('layouts.app')
@section('content')
@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<p id="demo"></p>

            <div class="card p-0 col-md-6">
            <?php
            $dirF='/upload/img/'.$order->file;
            $src=asset($dirF);
            ?>
                <div class="card-body">
                    <h5 class="card-title">{{$order->invoice}}</h5>
                    <table class="table table-sm mb-2">
                        <tbody>
                            <tr>
                                <td>name</td>
                                <td>: {{$order->name}}</td>
                            </tr>
                            <tr>
                                <td>status</td>
                                <td>: {{$order->getStatus($order->status)}}</td>
                            </tr>
                            <tr>
                                <td><img src="{{$src}}" alt="{{$order->file}}" class="img-thumbnail"></td>
                            </tr>
                            <tr>
                            <form action="{{route('order.upload',$order->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <tr>
                                <td colspan="3">
                                    <input type="file" name="file" id="file" class="form-control  @error('file') is-invalid @enderror">
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td><button type="submit" class="btn btn-primary">upload</button></td>
                            </tr>
                            </form>
                            <tr>
                                <td>cin</td>
                                <td>: {{$order->getCin()}}</td>
                            </tr>
                            <tr>
                                <td>cout</td>
                                <td>: {{$order->getCout()}}</td>
                            </tr>
                            <tr>
                                <td>bill</td>
                                <td>: {{$order->getBill()}}</td>
                            </tr>
                            @foreach($order->getORoom as $r)
                            <tr>
                                <td>{{$r->id}}</td>
                                <td>: {{$r->name}}</td>
                                <td>: {{$r->qty}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <small class="text-muted row">
                        <form action="{{ route('order.cancel', $order->id) }}" method="post">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <button class="btn btn-danger" type="submit">cancel</button>
                        </form>
                    </small>
                </div>
            </div>
    <!-- boodi -->
    <!-- @php
    $end=date('Y-m-d H:i:s', strtotime("+8 hours", strtotime(now())));
    echo $end;
    @endphp -->
 @endsection

 @section('script')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script>
    
    // var end="{{$end}}";
    // // Set the date we're counting down to
    // var countDownDate = new Date(end).getTime();
    // console.log();

    // // Update the count down every 1 second
    // var x = setInterval(function() {

    // // Get today's date and time
    // var now = new Date().getTime();
    // var no = new Date();
    // console.log(no);
    // // Find the distance between now and the count down date
    // var distance = countDownDate - now;
    // console.log(distance);

    // // Time calculations for days, hours, minutes and seconds
    // // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    // var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    // var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // // Display the result in the element with id="demo"
    // // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    // // + minutes + "m " + seconds + "s ";
    // if (distance > 0) {
    // document.getElementById("demo").innerHTML = hours + "hour "
    // + minutes + "miutes " + seconds + "seconds";
    // }
    // // If the count down is finished, write some text
    // if(distance < 3590000) {
    //     clearInterval(x);
    //     var u="http://localhost:8000/member/cancel/{{$order->id}}";
    //     var token='{{csrf_token()}}';
    //     $.ajax({
    //             url:u,
    //             method:'PUT',
    //             data:{_method:'PUT',_token:token},
    //             dataType: 'json',
    //             success: function(data){
    //                 document.getElementById("demo").innerHTML = "caceled";
    //             }
    //         });
    // }
    // }, 1000);
    </script>
    @endsection