@extends('index')
@section('content')
<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li class="active">{{ ucfirst($titles) }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ $titles }}</small></h3></div>
<div class="container">

<br>

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->



    @if(Auth::customer()->check())
    <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#add-testimony">New Testimony</button>
    @endif

    <div class="clearfix"></div>
    <br>
    
    <div class="jscroll">

        @foreach($testimonials as $testimony)
        <div class="well">
            <h4>{{ $testimony->title }}</h4>
            <p>{{ $testimony->content }}</p>
            <small>-- {{ $testimony->customer->firstname .' '. $testimony->customer->lastname }}</small>
        </div>
        @endforeach

        <a class="jscroll-next hidden" href="{{ $testimonials->nextPageUrl() }}">next page</a>

    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="add-testimony" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => route('testimony.store'),'id' => 'testimony-form']) !!}

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Testimony</h4>
      </div>
      <div class="modal-body">

          <div class="form-group">
            <input type="text" name="title" class="form-control" id="testimony-title" placeholder="Title">
          </div>
          <div class="form-group">
            <textarea type="text" name="content" rows="5" class="form-control" id="testimony-content" placeholder="Message"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary testimony-save">Send</button>
      </div>

        {!! Form::close() !!}

    </div>
  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

var lastPage = {{ $testimonials->lastPage() }} - 1;

$(document).ready(function() {
    
    $('.jscroll').jscroll({
        debug: false,
        autoTrigger: true,
        autoTriggerUntil: lastPage,
        loadingHtml: '<img src="assets/img/loading_bar.gif" alt="Loading" />',
        padding: 300,
        nextSelector: 'a.jscroll-next:last',
        pagingSelector: 'a.jscroll-next:last',
        callback: function () {
            console.log('loaded');
        }
    });

    // $('.testimony-save').click(function(event) {

    //     console.log('save clicked');

    //     $.post('api/testimony/save', {
    //         title: $('#testimony-title').val(), 
    //         content: $('#testimony-content').val(),
    //         _token: $('input[name=_token]').val()
    //     },
    //     function(data, textStatus, xhr) {

    //         if(textStatus == 'success') {

    //             console.log(data);
    //             $('#add-testimony').modal('hide');
    //         }
    //     });

    //     event.preventDefault();
    // });

});

</script>
@stop