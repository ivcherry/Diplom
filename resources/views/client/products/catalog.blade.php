@extends('client.layouts.clientLayout')
@section('breadcrumbs')
{{Breadcrumbs::render()}}
@endsection
@section('content')
<div>
    <h2>Каталог товаров</h2>
    <ul>
        @foreach($genericTypes as $genericType)
            <li>
                <a href="/category?categoryId={{$genericType->getId()}}">{{$genericType->getName()}}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection