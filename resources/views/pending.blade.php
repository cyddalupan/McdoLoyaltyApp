@extends('template')

@section('page_title')
  Pending
@stop

@section('content')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{url()}}/public/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="{{url()}}/public/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/Pending.css">

<div id="Pending">
    <div class="col-xs-12 image_loyalty">
        <img src="{{url()}}/public/IMG/Alpha_logo.png" height="140px" width="140px">
    </div>
    <div class="col-xs-12 header_title">
        <div class="row Loyaltytitle_pending">Loyalty App</div>
        <div class="row managerspage">Manager's&nbsp;Board</div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-1">
        </div>
        
        <div class="col-lg-4 col-md-12">
            @include('pendingRequest')
        </div>

        <div class="col-lg-2">
        </div>

        <div class="col-lg-4 col-md-12">

            @include('pendingBranchEvent')
        </div>
        <div class="col-lg-1">
        </div>
    </div>
</div>


@stop


