@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content">
    @foreach($exhibitions as $exhibition)
    <a href="{{ route('detail', $exhibition->id) }}" class="card__button card__button--compact">
        <div class="l-wrapper">
            <article class="card">
                <figure class="card__thumbnail">
                    <img src="{{$exhibition->product_image}}" alt="image" class="card__image">
                </figure>
                <h3 class="card__title">{{$exhibition->name}}</h3>
            </article>
        </div>
    </a>
    @endforeach
</div>
@endsection