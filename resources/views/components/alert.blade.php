@if (session()->has($name))
<div class="alert alert-success">
    {{session($nameC)}}
</div>

@endif
