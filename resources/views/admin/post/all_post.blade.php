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
                    <th>Thumbnail</th>
                    <th>Full Image</th>
                    <th>Desc</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{ asset('images/thumb/'.$post->thumb) }}" width="100px" alt="thumb"></td>
                        <td><img src="{{ asset('images/full_img/'.$post->full_img) }}" width="100px" alt="full_img"></td>
                        <td>{{ $post->details }}</td>
                        <td>
                            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <a onclick="confirm return('Are You Sure To Delete')" href="{{ route('post.delete',$post->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
