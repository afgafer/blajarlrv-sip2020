@extends('layouts.app')
@section('top')
<div class="container">
    <div class="row justify-content-center">
        <!-- img cor -->
        <div class="col-lg-3 p-0 bg-dark border border-dark">
            @if(isset($images))
            <div id="carouselExampleIndicators" style="height:300px;" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active text-center">
                        <img class="" style="height:300px;" src="/upload/img/logo.jpg" alt="logo.jpg">
                        <div class="carousel-caption d-none d-md-block">
                            <p></p>
                        </div>
                    </div>
                    @foreach($images as $i)
                    @php
                    $dirF='upload/img/'.$i->file;;
                    $src=asset($dirF);
                    @endphp
                    <div class="carousel-item text-center">
                        <img class="" style="height:300px;" src="{{$src}}" alt="{{$i->name}}">
                        <div class="carousel-caption d-none d-md-block">
                            <p>{{$i->desc}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @endif
        </div>
        <!--end img cor -->
        <!-- desc cor -->
        <div class="col-lg-8 bg-dark text-white p-2">
            @if(isset($event))
            @php
            $content=substr($event->desc,0,300);
            @endphp
            <h1 class="text-info">{{$event->name}}</h1>
            <small>{{$event->place}}, {{$event->date}}</small>
            <p><?=$content?></p>
            <div>
                <a href="{{route('event.showA',$event->id)}}" class="btn btn-primary btn-outline-light">read more</a>
            </div>
            @elseif(isset($dest))
            @php
            $content=substr($dest->desc,0,500);
            @endphp
            <h1 class="text-info">{{$dest->name}}</h1>
            <?=$content?>
            <div>
                <a href="{{route('dest.showA',$dest->id)}}" class="btn btn-primary btn-outline-light">read more</a>
            </div>
            @else
            <h1>empty</h1>
            @endif
        </div>
        <!--end desc cor -->
    </div>
</div>
@endsection

@section('content')
<!-- articles -->
<div id="article">
    <h1 class="title">new article</h1>
    <hr>
    @forelse($articles as $a)
    @php
    $dirF='upload/img/'.$a->file;
    $src=asset($dirF);
    $time=date_create($a->created_at);
    $date=date_format($time,'d/m/Y');
    $content=substr($a->content,0,250);
    $mod=$loop->iteration%2;
    @endphp
    @if($mod)
    <!-- card -->
    <div class="card mb-3 p-1">
        <div class="row no-gutters">
            <div class="col-md-3 align-self-center">
                <img src="{{$src}}" class="card-img" alt="{{$a->file}}">
            </div>
            <div class="col-md-8 ">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{$a->title}}</h4>
                    <p class="card-text"><?=$content?>... <a href="{{route('article.showA',$a->id)}}">read more</a></p>
                    <p class="card-text"><span class="badge badge-primary">{{$a->admin->name}}</span><span
                            class="badge badge-secondary">{{$date}}</span></p>
                </div>
            </div>
        </div>
    </div>
    <!--end card -->
    @else
    <!-- card -->
    <div class="card mb-3 p-1">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{$a->title}}</h4>
                    <p class="card-text"><?=$content?>... <a href="{{route('article.showA',$a->id)}}">read more</a></p>
                    <p class="card-text"><span class="badge badge-primary">{{$a->admin->name}}</span><span
                            class="badge badge-secondary">{{$date}}</span></p>
                </div>
            </div>
            <div class="col-md-3 align-self-center ml-auto">
                <img src="{{$src}}" class="card-img" alt="{{$a->file}}">
            </div>

        </div>
    </div>
    <!--end card -->
    @endif
    @empty
    <h5>empty</h5>
    @endforelse
    <!-- articles end-->
</div>
<!--end articles -->
<!-- rooms -->
<div id="rooms">
    <h1 class="title">room list</h1>
    <hr>
    @if(isset($rooms))
    <!-- row -->
    <div class="row row-cols-1 row-cols-md-4">
        @foreach($rooms as $r)
        @php
        $dirF='upload/img/'.$r->file;
        $src=asset($dirF);
        $price=number_format($r->price,0,'','.');
        @endphp
        <div class="col mb-4">
            <!-- card -->
            <div class="card h-100 border border-white font-weight-bold">
                <img src="{{$src}}" class="card-img-top" alt="{{$r->file}}">
                <div class="card-body">
                    <h5 class="card-title text-white badge badge-primary">No {{$r->id}}</h5>
                    <h5 class="card-title border badge badge-light">Rp {{$price}}</h5>
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>: <a href="{{route('room.showA',$r->id)}}">{{$r->name}}</a></td>
                            </tr>
                            <tr>
                                <td>cap</td>
                                <td>: {{$r->cap}}</td>
                            </tr>
                            <tr>
                                <td>hotel</td>
                                <td>: {{$r->hotel->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
            <!--end card -->
        </div>
        @endforeach
    </div>
    <!--end row -->
    @else
    <h5>empty</h5>
    @endif
</div>
<!-- rooms end-->
@endsection