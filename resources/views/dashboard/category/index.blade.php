@extends('layouts.layoute')
@section('title' , "eCommerce")
@section('barRigte')
@parent
<li class = "breadcrumb-item active"> Categorys </li>
@endsection
@section('content')
@section('btn')
 <a href="{{route('createCategory')}}" class="btn btn-sm btn-outline-primary">Create</a>
 <a href="{{route('trachCategories')}}" class="btn btn-sm btn-outline-black">Trashed</a>
@endsection

<x-alert name="success" nameC="success" />
<x-alert name="successDelete" nameC="successDelete" />

    <form class="d-flex justify-content-between mb-4" action="{{ route('index') }}">
        <x-form.validate type="text" name="name" placeholder="Name" class="form-control" />
        <select name="status" class="form-control">
            <option value="active">Active</option>
            <option value="archived">Archived</option>
        </select>
        <button type="submit" class="btn btn-dark">Filter</button>
    </form>



    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>image</th>
                <th>name</th>
                <th>parent</th>
                <th>products #</th>
                <th>status</th>
                <th>created_at</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count())
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    {{-- هنا احنا عشان نستخدم الاسيت ويشوفها بالببليك لازم اعمل كوماند وهو : --}}
                    {{-- php artisan storage:link --}}
                    {{-- هيك احنا عملنا اختصار لملف الصور الي بالستورج داخل ملف الببليك الاساسي  --}}
                    {{-- وحطينا كلمة ستوريج من اجل انو يشوفها لانو محطوط داخل مجلد اسمو ستوريج --}}
                    <td> <img src="{{asset('storage/' . $category->image)}}" height="50px" alt=""></td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->parent_name ?? ' - '}}</td>
                    {{-- دائما لما ارجع الكاونت بستخدم اسم الريليشن واندرسكور كاونت --}}
                    <td>{{$category->product_count}}</td>
                        <td @if ($category->status == "active")
                            class="text-success" @endif
                        class="text-danger">{{$category->status}}</td>
                    <td>{{$category->created_at}}</td>

                    <td> <a class="btn btn-sm btn-outline-primary" href="{{route('edite' , $category->id)}}">edite</a> </td>
                    <td> <a class="btn btn-sm btn-outline-success" href="{{route('showCategory' , $category->id)}}">show</a> </td>
                    <td>
                        <form action="{{route('delete' , $category->id)}}" method="GET">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-outline-danger" type="submit">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="7">No Category Yet</td>
                </tr>
                @endif
        </tbody>

    </table>
    {{--  عشان اخليه يدعم البوتستراب بحطلو الكلاب هاد جوا اللينك--}}
    {{-- الويذ كويري سترينج عشان لما ااجي اعمل فلترة ويروح للبجينيشن التاني يضلو حافظ بال يو ار ال قيمة الفلترة وما تروح --}}
    {{$categories->withQueryString()->links('pagination::bootstrap-4')}}
@endsection
