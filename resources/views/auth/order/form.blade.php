@extends('layouts.app')
@section('content')
<h1 class="title">Search</h1>
<hr>
            <form action="{{route('order.select')}}" method='get'>
                <!-- @csrf -->
                <div class="form-row">
                    <div class="col-9 mb-4">
                        <label for="cin">check in</label>
                        <input type="date" class="form-control @error('cin') is-invalid @enderror" name="cin" min="{{date('Y-m-d')}}"  value="{{session()->get('cin')}}">
                        <strong>check in 14.00 WIB check out 12.00 WIB</strong>
                        @error('cin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-3 mb-1">
                        <label for="duration">duration</label>
                        <input type="number" class="form-control @error('duration') is-invalid @enderror" min="1" value="1" name="duration"  >
                        @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="form-group">
                        <label for="cout">cout</label>
                        <input type="date" class="form-control" name="cout"  value="{{session()->get('cin')}}" readonly>
                </div> -->
                <button class="btn btn-primary" type="submit">search</button>
            </form>
 @endsection