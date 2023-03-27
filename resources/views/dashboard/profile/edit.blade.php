@extends('layouts.layoute')
@section('title' , "Edit Profile")

@section('content')

<form class="form-horizontal" action="{{route('profileUpdate')}}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
      <label class="control-label col-sm-2" >First Name</label>
      <div class="col-sm-10">
          {{-- هان ظهرت فائدة الويذ ديفولت الي حطيتها بمودل اليوزر انو عملتي اوبجكت فاضي
            ف لهيك ما طلعلي ايرور لما حبت الفيرست نيم
            فانا لو نسيت اضيف الويذ ديفولت واليوزر تبعنا ما كان الو بروفايل هيطلع ايرور  --}}
        <input type="text" value="{{$user->profile->first_name}}" name="first_name" class="form-control" placeholder="first Name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Last Name</label>
      <div class="col-sm-10">
        <input type="text" value="{{$user->profile->last_name}}" name="last_name" class="form-control" id="pwd" placeholder="Last Name">
      </div>
    </div>

    <div class="form-inline ">

        <div class="form-group">
            <label> Birthday : </label>
          <input type="date" value="{{$user->profile->birthday}}"  name="birthday" class="form-control" placeholder="birthday">
        </div>

        <div class="form-group ">
            <label  >Gender : </label>
            <input class="form-check-input" type="radio" name="gender" class="form-control " value="male">
            <label for="">male</label>

            <input class="form-check-input" type="radio" name="gender" class="form-control " value="female">
            <label for="">fe-male</label>
          </div>

      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Street</label>
        <div class="col-sm-5">
          <input type="text" value="{{$user->profile->street_address}}" name="street_address" class="form-control" id="pwd" placeholder="Street">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">City</label>
        <div class="col-sm-5">
          <input type="text" value="{{$user->profile->city}}" name="city" class="form-control" id="pwd" placeholder="city">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">State</label>
        <div class="col-sm-5">
          <input type="text" value="{{$user->profile->state}}" name="state" class="form-control" id="pwd" placeholder="state">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2">Country</label>
        <div class="col-sm-5">
          {{-- <select type="text" name="last_name" class="form-control" id="pwd" placeholder="Last Name"> --}}
              <select class="form-control" name="country" >
                  @foreach ($countries as $country => $text)
                    <option value="{{$country}}">{{$text}}</option>
                  @endforeach

              </select>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Postal Code</label>
            <div class="col-sm-5">
              <input type="text" name="postal_code" value="{{$user->profile->postal_code}}" class="form-control"
               placeholder="Postal Code">
            </div>
      </div>



    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
@endsection
