@extends('admin.master')
@section('admin_content')
<div class="card p-5 my-5">
    <div class="d-flex justify-content-between">
        <h4 class="text-info mb-2">Add Post</h4>

        <a href="{{ route('post.index') }}" class="btn btn-sm btn-success">All Posts</a>
    </div>
    <hr class="mb-3 text-success" />
    @if($errors)
    @foreach($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>
    @endforeach
    @endif

    @if(Session::has('error'))
    <p class="text-danger">{{ session('error') }}</p>
    @endif

    @if(Session::has('message'))
    <p class="text-success">{{ session('message') }}</p>
    @endif

    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <tr>
                <th>Category</th>
                <td>
                    <select style="cursor: pointer" name="category" id="" class="form-control">
                        <option value="">-- Select Category --</option>
                        @forelse ($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                        @empty
                            <p>Category Not Available</p>
                        @endforelse
                    </select>
                </td>
            </tr>
        </table>
        <div class="form-group mb-2">
            <label for="title">Enter Post Title</label>
            <input type="text" name="title" id="title" placeholder="Enter Title" class="form-control mt-3">
        </div>
        <div class="form-group mb-2">
            <label for="thumb">Choose Post Thumbnail</label>
            <input type="file" name="thumb" id="thumb" class="form-control mt-3">
        </div>
        <div class="form-group mb-2">
            <label for="full_img">Choose Post Photo</label>
            <input type="file" name="full_img" id="full_img" class="form-control mt-3">
        </div>
        <div class="form-group mb-2">
            <label for="details">Enter Post Description</label>
            <textarea name="details" id="details" class="form-control mt-3" cols="30" rows="10" placeholder="Write Post Details"></textarea>
        </div>
        <div class="form-group mb-2">
            <label for="tag">Enter Tags</label>
            <textarea name="tag" id="tag" class="form-control mt-3" cols="30" rows="10" placeholder="Write Tags"></textarea>
        </div>
        <button type="submit" class="btn btn-sm btn-info">Create Post</button>
    </form>
</div>
@endsection
