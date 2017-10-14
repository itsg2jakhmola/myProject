@if (session('status'))
    <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{ session('error') }}
    </div>
@endif

@if(isset($errors) && count($errors) > 0)
  <div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      Following fields required!!
  </div>
@endif
