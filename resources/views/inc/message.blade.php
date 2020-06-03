@if(count($errors)>0)
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
    @foreach($errors->all() as $error) {{$error}} <br>
{{--    Warning alert preview. This alert is dismissable.--}}
    @endforeach
</div>
@endif
