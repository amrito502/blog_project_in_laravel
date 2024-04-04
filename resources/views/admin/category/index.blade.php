@extends('admin.master')
@section('admin_content')
    <div class="card p-5 my-5">
        <div class="d-flex justify-content-between">
            <h4 class="text-info mb-2">Add Category</h4>

            <a href="{{ route('category.create') }}" class="btn btn-sm btn-success">Add Category</a>
        </div>
        <hr class="mb-3 text-success" />
        <table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Desc</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td><img src="{{ asset('images/'.$category->image) }}" width="100px" alt="category"></td>
                        <td>{{ $category->details }}</td>
                        <td>
                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <a onclick="confirm return('Are You Sure To Delete')" href="{{ route('category.delete',$category->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
