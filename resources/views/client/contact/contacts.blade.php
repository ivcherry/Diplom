@extends('client.layouts.clientLayout')
@section('breadcrumbs')
<div>
    {{Breadcrumbs::render('contacts')}}
</div>
@endsection
@section('content')
<div id="contactsContent">
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
       $.get('/contacts/getContent', function (response) {
           $("#contactsContent").html(response);
       });
    });
</script>
@endsection
