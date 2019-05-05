@extends('client.layouts.clientLayout')
@section('breadcrumbs')
<div>
    {{Breadcrumbs::render('contacts')}}
</div>
@endsection
@section('content')
<div id="technicalSupportContent">
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
       $.get('/technicalSupport/getContent', function (response) {
           $("#technicalSupportContent").html(response);
       });
    });
</script>
@endsection
