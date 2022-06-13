@extends('layouts.app')

@section('content')

    <div class="container">

        @if ('message')
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif


        <div>
            <a class="badge badge-pill p-3 bg-success text-white" href="{{route('admin.categories.create')}}">
                Create Category
            </a>
        </div>

        @forelse ($categories as $category )
        <table class="table">
            <thead>
              <tr>
                <th>label</th>
                <th>color</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $category->label}}</td>
                <td>{{ $category->color}}</td>
                <td>
                    <a class="badge badge-pill p-3 bg-primary text-white" href="{{route('admin.categories.show', $category->id)}}">
                      View
                  </a>
                </td>
                <td>
                  <a class="badge badge-pill p-3 bg-success text-white" href="{{route('admin.categories.edit', $category->id)}}">
                      Modify
                  </a>
                </td>
                <td>
                    {{-- <form action="{{ route('admin.posts.destroy', $data->id)}}" method="POST">
                        @method('DELETE')
                        @csrf

                        <button class="delete-form" type="submit" src="{{ route('admin.posts.destroy', $data->id)}}" class="">Delete</button>

                    </form> --}}
                    @include('includes.delete-category')
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
