@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="product-detail">

    <div class="product-detail">
        <h2>{{ $exhibition->name }}</h2>
        <img src="{{ asset('storage/' . $exhibition->product_image) }}" alt="image" class="product-image">
        <p>{{ $exhibition->detail }}</p>
        <p>価格：&yen; {{ number_format($exhibition->price) }}</p>

        <form action="{{ route('favorites.store') }}" method="POST" style="margin-top: 10px;">
            @csrf
            <input type="hidden" name="exhibition_id" value="{{ $exhibition->id }}">
            <button type="submit" class="favorite-button">★ お気に入りに追加</button>
        </form>
        <p><a href="{{ route('login') }}">ログイン</a>してお気に入り登録</p>

        <form action="{{ route('purchase.confirm') }}" method="POST">
            @csrf
            <input type="hidden" name="item_id" value="{{ $exhibition->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit">購入手続きへ</button>
        </form>
    </div>

    <div class="comments">
        <h3>コメント</h3>
        @foreach($exhibition->comments as $comment)
        <div class="comment">
            <strong>{{ $comment->user_name }}</strong>
            <p>{{ $comment->comment }}</p>
            <small>{{ $comment->created_at->format('Y/m/d H:i') }}</small>
        </div>
        @endforeach
    </div>

    {{-- コメント投稿フォーム --}}
    <div class="comment-form">
        <h4>コメントを投稿する</h4>
        @if(session('success'))
        <p class="success">{{ session('success') }}</p>
        @endif
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="exhibition_id" value="{{ $exhibition->id }}">
            <div>
                <label for="user_name">お名前:</label>
                <input type="text" name="user_name" id="user_name" required>
            </div>
            <div>
                <label for="comment">コメント:</label>
                <textarea name="comment" id="comment" required></textarea>
            </div>
            <button type="submit">投稿</button>
        </form>
    </div>
</div>
@endsection