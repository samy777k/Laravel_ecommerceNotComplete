@extends('layouts.layoute')
@section('title' , "Create Product")



@section('content')
@if (session()->has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif
<form action="{{route('storeProduct')}}" enctype="multipart/form-data" method="POST">
    @csrf
    @include('dashboard.category._form');
  </form>

@endsection




