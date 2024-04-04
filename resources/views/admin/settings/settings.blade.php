@extends('admin.master')
@section('admin_content')
<div class="card p-5 my-5">
    <div class="d-flex justify-content-between">
        <h4 class="text-info mb-2">Manage Settings</h4>
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

    <form action="{{ route('admin.save_settings') }}" method="post">
        @csrf
        <table>
            <tr>
                <th style="display: inline-block; margin-right:30px;" class="mt-4"><label for="">Comment Auto Approve</label><span class="text-danger">*</span></th>
                <td ><input type="text" name="comment_auto" @if($setting) value="{{ $setting->comment_auto }}" @endif  class="form-control mt-3"></td>
            </tr>
            <tr>
                <th style="display: inline-block; margin-right:30px" class="mt-4"><label for="">User Auto Approve</label><span class="text-danger">*</span></th>
                <td><input type="text" name="user_auto" @if($setting) value="{{ $setting->user_auto }}" @endif  class="form-control mt-3"></td>
            </tr>
            <tr>
                <th style="display: inline-block; margin-right:30px" class="mt-4"><label for="">Recent Post Limit</label><span class="text-danger">*</span></th>
                <td><input type="text" name="recent_limit" @if($setting) value="{{ $setting->recent_limit }}" @endif  class="form-control mt-3"></td>
            </tr>
            <tr>
                <th style="display: inline-block; margin-right:30px" class="mt-4"><label for="">Popular Post Limit</label><span class="text-danger">*</span></th>
                <td><input type="text" name="popular_limit" @if($setting) value="{{ $setting->popular_limit }}" @endif  class="form-control mt-3"></td>
            </tr>
            <tr>
                <th style="display: inline-block; margin-right:30px" class="mt-4"><label for="">Recent Comment Limit</label><span class="text-danger">*</span></th>
                <td><input type="text" name="recent_comment_limit" @if($setting) value="{{ $setting->recent_comment_limit }}" @endif  class="form-control mt-3"></td>
            </tr>
        </table>


        <button type="submit" class="btn btn btn-success mt-4">Save Settings</button>
    </form>
</div>
@endsection

