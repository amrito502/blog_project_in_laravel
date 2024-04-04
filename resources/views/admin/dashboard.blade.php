@extends('admin.master')
@section('admin_content')

@if(Session::has('adminData'))
<p>login</p>
@endif

@endsection
