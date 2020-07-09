@extends('layouts.app')
@section('content')

@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif

<h1 class="title">admins</h1>
<a href="{{route('admin.create')}}" class="btn btn-primary btn-sm">create</a>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">
                                Launch demo modal
                            </button>
<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <!--modal -->
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content p-2">
    <div class="container te">
    <form method="POST" action="{{ route('admin.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label ">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label ">email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-12 col-form-label ">contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact">

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hotel_id" class="col-md-12 col-form-label ">dest</label>

                            <div class="col-md-6">
                                <select name="dest_id" class="form-control">
                                    <option disable selected>--choice--</option>
                                    @forelse($dests as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                    @empty
                                    <option disable selected>empty</option>
                                    @endforelse
                                </select>   

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hotel_id" class="col-md-12 col-form-label ">hotel</label>

                            <div class="col-md-6">
                                <select name="hotel_id" class="form-control">
                                    <option disable selected>--choice--</option>
                                    @forelse($hotels as $h)
                                    <option value="{{$h->id}}">{{$h->name}}</option>
                                    @empty
                                    <option disable selected>empty</option>
                                    @endforelse
                                </select>   

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label ">password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label ">password confirm</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    register
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
    </div>
  </div>
  <!--end modal -->
</div>
<div class="scroll">
    <table class="table table-sm bg-white mb-2 ">
        <tbody>
            <tr class="bg-primary text-white">
                <th>no</th>
                <th>username</th>
                <th>email</th>
                <th>hotel</th>
                <th></th>
            </tr>
            @forelse($admins as $a)
            @php
            $dirF='upload/img/'.$a->file;
            $src=asset($dirF);
            //$time=date_create($a->created_at);
            //$date=date_format($time,'d-m-Y');
            //$content=substr($a->content,0,500);
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <img src="{{$src}}" alt="{{$a->file}}" class="img-thumbail img-s">
                    <a href="{{route('admin.show',$a->id)}}">{{$a->name}}</a>
                </td>
                <td>{{$a->email}}</td>
                <td>
                <div class="btn-group">
                    <a href="{{route('admin.edit',$a->user->id)}}" class="btn btn-primary btn-sm mr-1">edit</a>
                    <form action="{{route('admin.destroy',$a->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                    </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">empty</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection