@extends('layouts.app')
@section('content')
            <div class="card p-0 col-md-6">
            <?php
            $dirF='/upload/img/'.$order->file;
            $src=asset($dirF);
            ?>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>name</td>
                                <td>: {{$order->name}}</td>
                            </tr>
                            <tr>
                                <td><img src="{{$src}}" alt="{{$order->file}}" class="img-thumbnail"></td>
                            </tr>
                            <form action="{{route('order.upload',$order->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- <tr>
                                <td colspan="3"><input type="file" name="file" id="file" class="form-control"></td>
                            </tr>-->
                            <tr>
                                <td>cin</td>
                                <td>: {{$order->cin}}</td>
                            </tr>
                            <tr>
                                <td>cout</td>
                                <td>: {{$order->cout}}</td>
                            </tr>
                            <tr>
                                <td>status</td>
                                <td>: {{$order->getStatus($order->status)}}</td>
                            </tr>
                            </form>
                            <tr>
                                <td>bill</td>
                                <td>: {{$order->bill}}</td>
                            </tr>
                            <tr>
                                <td>count</td>
                                <td>: {{$order->count}}</td>
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
                </div>
            </div>
    <!-- boodi -->
 @endsection
