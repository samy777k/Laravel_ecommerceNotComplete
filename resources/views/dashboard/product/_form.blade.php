    @if ($errors->any()){
        <div class="alert alert-danger">
            <h1>Error Ecured!!</h1>
            <ul>
                @foreach ($errors->all() as $msgError)
                <li> {{$msgError}} </li>
                @endforeach
            </ul>
        </div>
    }

    @endif

<div class="card-body">
    <div class="form-group">
      <label for="exampleInputEmail1">Product Name</label>

      {{-- هاد انشئت اشي اسمو كومبوننت عن طريق : --}}
      {{-- php artisan make:compnent form.validate --}}
      {{-- ويتم وضع متغيرات فيه وبستدعيه بهذه الطريقة --}}
     <x-form.validate class="form-control" type="text"  name="name" value="{{$category->name}}" />


    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Category Parent</label>
          <select name="parent_id" id="" class="form-control form-select @error('parent_id') is-invalid  @enderror">
              <option value=""></option>
              @foreach ($categories as $categoryy)
              <option value="{{$categoryy->id}}">{{$categoryy->name}}</option>
              @endforeach
          </select>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Category Description</label>
      <textarea class="form-control" id="exampleInputEmail1"  name="description">{{old('description') ?? $category->discription}}</textarea>
    </div>

    <div class="form-group">
      <label for="exampleInputFile">Category Image</label>
      <div class="input-group">
        <div class="custom-file">
          {{-- <input name="image" type="file" class="custom-file-input @error('image') is-invalid  @enderror" id="exampleInputFile"> --}}
          <x-form.validate class="custom-file-input" type="file"  name="image" />
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        @error('image')
            <div class="text-danger">
                {{$message}}
            </div>
        @enderror
      </div>
      @if ($category->image)
      <img src="{{asset('storage/' . $category->image)}}" height="60px" alt="">
    @endif
    </div>
   <div class="form-groub">
       <label for="">Status</label>
       <div class="form-check">
           {{-- <input class="form-check-input @error('image') is-invalid  @enderror" value="active" type="radio" name="radio" id="flexRadioDisabled" checked> --}}
           <x-form.validate class="form-check-input" type="radio" value="active"  name="radio" checked />
           <label class="form-check-label" for="flexRadioDisabled">
            active
          </label>
        </div>
        <div class="form-check">
            {{-- <input class="form-check-input @error('image') is-invalid  @enderror" value="archived" type="radio" name="radio" id="flexRadioCheckedDisabled" > --}}
            <x-form.validate class="form-check-input" type="radio" value="archived"  name="radio" />
            <label class="form-check-label" for="flexRadioCheckedDisabled">
            archived
          </label>
        </div>
   </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
