@extends('layouts.app')

@section('content')

    <div>
        <form style="display: flex; flex-direction: column; width: 80%; margin: 0 auto;"
              action="{{ route('admin.posts.store')}}" method="POST">
            @csrf

            <label for="image">Image</label>
            <input type="text" value="" name="image">

            <label for="title">Title</label>
            <input type="text" value="" name="title">

            <div>
                <label for="category">Category</label>
                <select name="category_id" id="category">
                    <option value="">Nessuna categoria</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->label}}</option>
                    @endforeach
                </select>
            </div>

            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10">

            </textarea>

            {{-- <label for="slug">Slug</label>
            <input type="text" value="" name="slug"> --}}

            <button class="btn btn-success w-25 b-rounded-3" style="margin: 10px auto;" type="submit" src="{{route('admin.posts.store')}}">
                Create
            </button>
        </form>
    </div>



@endsection
