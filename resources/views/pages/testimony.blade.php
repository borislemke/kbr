@extends('index')

@section('meta_description', '')
@section('meta_keyword', '')

@section('content')
<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ route('home') }}">{{ trans('url.home') }}</a></li>
        <li class="active">{{ trans('url.testimonials') }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ trans('url.testimonials') }}</small></h3></div>
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

@if(Auth::customer()->check())
<!-- Modal -->
<div class="modal fade" id="add-testimony" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => route('api.testimony.store'),'id' => 'testimony-form']) !!}

        <input type="hidden" value="{{ Auth::customer()->get()->id }}" name="customer_id">

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
@endif

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

    $('.testimony-save').click(function(event) {

        console.log('save clicked');

        var frm = $('#testimony-form'),
        url = frm.attr('action'),
        data = frm.serialize();;

        $.post(url, data, function(data, textStatus, xhr) {

            if(data.status == 200) {

                $('#add-testimony').modal('hide');

                $('input').val('');
                $('textarea').val('');
            }
        });

        event.preventDefault();
    });

});

</script>
@stop