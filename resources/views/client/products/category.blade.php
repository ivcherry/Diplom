@extends('client.layouts.clientLayout')
@section('breadcrumbs')
    {{Breadcrumbs::render('category', $genericType)}}
@endsection
@section('content')
    <div>
        <h3>{{$genericType->getName()}}</h3>
        <ul>
            @foreach($genericType->getTypes() as $type)
                <li>
                    <a href="/products?subCategory={{$type->getId()}}">{{$type->getName()}}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
