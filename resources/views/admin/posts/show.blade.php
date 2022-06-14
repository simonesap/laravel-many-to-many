@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>image</th>
                    <th>title</th>
                    <th>category</th>
                    <th>content</th>
                    <th>tag</th>
                    <th>slug</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ $post->image}}" alt="">
                    </td>
                    <td>{{ $post->title}}</td>
                    <td>
                        @if($post->category)
                            <span class="badge badge-pill badge-{{$post->category->color}}">
                                {{$post->category->label}}
                            </span>
                        @else
                            Category null
                        @endif
                    </td>

                    <td>{{ $post->content}}</td>

                    <td>
                        @forelse ($post->tags as $tag)
                            <span class="badge badge-pill" style="background-color: {{$tag->color}};">
                                {{$tag->label}}
                            </span>

                        @empty

                        @endforelse
                    </td>


                    <td>{{ $post->slug}}</td>
                    <td>
                        <a class="badge badge-pill p-3 bg-success text-white" href="{{route('admin.posts.edit', $post->id)}}">
                            Modify
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $post->id)}}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button class="delete-form badge badge-pill p-3 bg-danger text-white" type="submit" src="{{ route('admin.posts.destroy', $post->id)}}" class="">Delete</button>

                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('js/delete-form.js')}}"></script>

@endsection
