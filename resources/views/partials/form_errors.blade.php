<ul>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <li class="text-danger form-errors-alert">{{$error}}</li>
        @endforeach
    @endif
</ul>

<style>
    .form-errors-alert{
        background: #f5c1af;
        padding: 20px;
    }
</style>