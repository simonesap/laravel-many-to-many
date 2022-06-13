@extends('layouts.app')

@section('content')

    <div class="container">

        @if ('message')
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif


        <div>
            <a class="badge badge-pill p-3 bg-success text-white" href="{{route('admin.posts.create')}}">
                Create Post
            </a>
        </div>

        @forelse ($datas as $data )
        <table class="table">
            <thead>
              <tr>
                <th>image</th>
                <th>title</th>
                <th>category</th>
                <th>content</th>
                <th>slug</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                    <img src="{{ $data->image}}" alt="">
                </td>
                <td>{{ $data->title}}</td>
                <td>
                    @if($data->category)
                        <span class="badge badge-pill badge-{{$data->category->color}}">
                            {{$data->category->label}}
                        </span>
                    @endif
                </td>
                <td>{{ $data->content}}</td>
                <td>{{ $data->slug}}</td>
                <td>
                    <a class="badge badge-pill p-3 bg-primary text-white" href="{{route('admin.posts.show', $data->id)}}">
                      View
                  </a>
                </td>
                <td>
                  <a class="badge badge-pill p-3 bg-success text-white" href="{{route('admin.posts.edit', $data->id)}}">
                      Modify
                  </a>
                </td>
                <td>
                    {{-- <form action="{{ route('admin.posts.destroy', $data->id)}}" method="POST">
                        @method('DELETE')
                        @csrf

                        <button class="delete-form" type="submit" src="{{ route('admin.posts.destroy', $data->id)}}" class="">Delete</button>

                    </form> --}}
                    @include('includes.delete-btn-post-index')
                </td>
              </tr>
            </tbody>
          </table>
        @empty

        @endforelse

        {{-- @if ($data->hasPages())
            {{$data->links()}}
        @endif --}}
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('js/delete-form.js')}}"></script>

@endsection
