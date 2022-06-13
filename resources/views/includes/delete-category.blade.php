<form action="{{ route('admin.categories.destroy', $category->id)}}" method="POST">
    @method('DELETE')
    @csrf

    <button class="delete-form badge badge-pill p-3 bg-danger text-white" type="submit" src="{{ route('admin.categories.destroy', $category->id)}}" class="">Delete</button>

</form>
