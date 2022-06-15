@extends('layouts.app')

@section('content')

    <div class="container">
        <form style="display: flex; flex-direction: column; width: 80%; margin: 0 auto;"
              action="{{ route('admin.posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
              @method('PUT')
                @csrf

                <label for="image">Image</label>
                <input type="file" id="image" name="image">

            <label for="title">Title</label>
            <input type="text" value="{{ old('title', $post->title)}}" name="title" required>

            <div>
                <label for="category">Category</label>
                <select name="category_id" id="category">
                    <option value="">
                            Nessuna categoria
                    </option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if (old('category_id', $post->category_id) == $category->id) selected

                                @endif>
                                {{$category->label}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div >
                @forelse ($tags as $tag )
                    <label for="tags">{{ $tag->label}}</label>
                    <input style="margin-right: 10px" type="checkbox" id="tag-{{$tag->label}}-{{$tag->id}}"
                           name="tags[]"
                           value="{{$tag->id}}"
                           @if ( in_array($tag->id, old('tags', $post_tag_id) ))
                           checked
                           @endif>
                @empty

                @endforelse

            </div>

            <div class="d-flex flex-column w-25">
                <label for="content">Content</label>
                <textarea value="" name="content" id="content" cols="30" rows="10" required>
                    {{ old('content', $post->content)}}
                </textarea>
            </div>

            {{-- <label for="slug">Slug</label>
            <input type="text" value="{{ old('slug', $post->slug)}}" name="slug" required> --}}

            <button class="btn btn-success w-25 b-rounded-3" style="margin: 10px auto;" type="submit" src="{{route('admin.posts.update', $post->id)}}">
                Modify
            </button>
        </form>
    </div>



@endsection
