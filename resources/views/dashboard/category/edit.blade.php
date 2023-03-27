@extends('layouts.layoute')
@section('title' , "Edite Category")



@section('content')

<form action="{{route('updateCategory' , $category->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    @include('dashboard.category._form');
  </form>

@endsection




