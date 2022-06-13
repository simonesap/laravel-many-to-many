<form action="{{ route('admin.posts.destroy', $data->id)}}" method="POST">
    @method('DELETE')
    @csrf

    <button class="delete-form badge badge-pill p-3 bg-danger text-white" type="submit" src="{{ route('admin.posts.destroy', $data->id)}}" class="">Delete</button>

</form>
