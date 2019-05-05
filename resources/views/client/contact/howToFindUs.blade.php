@extends('client.layouts.clientLayout')
@section('breadcrumbs')
<div>
    {{Breadcrumbs::render('howToFindUs')}}
</div>
@endsection
@section('content')
<div id="howToFindUsContent">
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
       $.get('/howToFindUs/getContent', function (response) {
           $("#howToFindUsContent").html(response);
       });
    });
</script>
@endsection
