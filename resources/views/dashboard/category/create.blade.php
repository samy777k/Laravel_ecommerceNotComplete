@extends('layouts.layoute')
@section('title' , "Create Category")



@section('content')
@if (session()->has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif
<form action="{{route('storeCategory')}}" enctype="multipart/form-data" method="POST">
    @csrf
    @include('dashboard.category._form');
  </form>

@endsection




