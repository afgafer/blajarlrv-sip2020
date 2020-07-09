@extends('lay.app')
@section('content')
<form action="{{route('cart.create')}}" method='post'>
    {{csrf_field()}}
                <div class="form-row mx-2">
                    <div class="col-8 mb-4">
                        <label for="namaPemesan">namaPemesan</label>
                        <input type="text" class="form-control" name="namaPemesan" placeholder="namaPemesan"  value="{{old('namaPemesan')}}" required>
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-6 mb-4">
                        <label for="masuk">masuk</label>
                        <input type="date" class="form-control" name="masuk" placeholder="masuk" required>
                    </div>
                    <div class="col-6 mb-1">
                        <label for="keluar">keluar</label>
                        <input type="date" class="form-control" name="keluar" placeholder="keluar" required>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
 @endsection