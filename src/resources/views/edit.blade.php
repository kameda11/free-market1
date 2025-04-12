@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="address-edit-container">
    <h2>住所の変更</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="address-edit-form">
        @csrf

        {{-- ユーザー名変更 --}}
        <div class="form-group">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $user->name) }}" required>
        </div>

        {{-- プロフィール画像変更 --}}
        <div class="form-group">
            <label for="profile_image" class="form-label">プロフィール画像</label>
            <input type="file" name="profile_image" id="profile_image" class="form-input">
        </div>

        {{-- 住所変更 --}}
        <div class="form-group">
            <label for="post_code" class="form-label">郵便番号</label>
            <input type="text" name="post_code" id="post_code" class="form-input" value="{{ old('post_code', $user->post_code) }}" placeholder="123-4567">
        </div>