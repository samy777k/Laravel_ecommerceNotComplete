@extends('layouts.layoute')
@section('title' , $categorys->name)
@section('barRigte')
@parent
<li class = "breadcrumb-item active"> Categoryss </li>
@endsection
@section('content')

    <table class="table">
        <thead>
            <tr>

                <th>product</th>
                <th>store</th>
                <th>status</th>
                <th>created_at</th>

            </tr>
        </thead>
        <tbody>
            @if ($categorys->product->count())
            {{-- هيك انا حكيتلو هاتلي الي جوا البرودكت نفسو --}}
            @foreach ($categorys->product as $product)
            {{-- هيك استخدمت الريليشن نفسها وبقدر اعمل عليها عمليات --}}
            {{-- @foreach ($categorys->product()->with('store')->paginate(5) as $product) --}}
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->store->name}}</td>
                    <td @if ($product->status == "active")
                        class="text-success" @endif
                        class="text-danger">{{$product->status}}</td>
                    <td>{{$product->created_at}}</td>

                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="7">No Products Yet</td>
                </tr>
                @endif
        </tbody>

    </table>
    {{--  عشان اخليه يدعم البوتستراب بحطلو الكلاب هاد جوا اللينك--}}
    {{-- الويذ كويري سترينج عشان لما ااجي اعمل فلترة ويروح للبجينيشن التاني يضلو حافظ بال يو ار ال قيمة الفلترة وما تروح --}}
    {{-- {{$categorys->withQueryString()->links('pagination::bootstrap-4')}} --}}
@endsection
