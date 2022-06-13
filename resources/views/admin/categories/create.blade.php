@extends('layouts.app')

@section('content')

    <div>
        <form style="display: flex; flex-direction: column; width: 80%; margin: 0 auto;"
              action="{{ route('admin.categories.store')}}" method="POST">
            @csrf

            <label for="label">Label</label>
            <input type="text" value="" name="label">

            <label for="color">Color</label>
            <input type="text" value="" name="color">


            <button class="btn btn-success w-25 b-rounded-3" style="margin: 10px auto;" type="submit" src="{{route('admin.categories.store')}}">
                Create
            </button>
        </form>
    </div>



@endsection
