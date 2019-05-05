@extends('client.layouts.clientLayout')
@section('breadcrumbs')
<div>
    {{Breadcrumbs::render('companyHistory')}}
</div>
@endsection
@section('content')
<div id="historyContent">
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
       $.get('/companyHistory/getContent', function (response) {
           $("#historyContent").html(response);
       });
    });
</script>
@endsection