@extends('admin.master')
@section('admin_content')
<div class="card p-5 my-5">
    <div class="d-flex justify-content-between">
        <h4 class="text-info mb-2">Add Category</h4>

        <a href="{{ route('category.index') }}" class="btn btn-sm btn-success">All Category</a>
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

    <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group mb-2">
            <label for="title">Enter Category Title</label>
            <input type="text" name="title" id="title" value="{{ $category->title }}" class="form-control mt-3">
        </div>
        <div class="form-group mb-2">
            <label for="image">Choose Category Photo</label>
            <input type="hidden" name="image" value="{{ $category->image }}">
            <img src="{{ asset('images/'.$category->image) }}" width="100px" alt="category">
            <input type="file" name="image" id="image" class="form-control mt-3">
        </div>
        <div class="form-group mb-2">
            <label for="details">Enter Category Title</label>
            <textarea name="details" id="details" class="form-control mt-3" cols="30" rows="10" >{!! $category->details !!}</textarea>
        </div>
        <button type="submit" class="btn btn-sm btn-info">Update Category</button>
    </form>
</div>
@endsection
