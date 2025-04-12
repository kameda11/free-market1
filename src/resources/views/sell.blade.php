@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">商品を出品する</h2>

    <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        {{-- 商品画像 --}}
        <div>
            <label for="image" class="block font-medium mb-2">商品画像</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full border border-gray-300 p-2 rounded">
            @error('image')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- カテゴリー --}}
        <div>
            <label for="category" class="block font-medium mb-2">カテゴリー</label>
            <select name="category" id="category" class="w-full border border-gray-300 p-2 rounded">
                <option value="">選択してください</option>
                <option value="fashion">ファッション</option>
                <option value="electronics">家電</option>
                <option value="books">本</option>
                <option value="others">その他</option>
            </select>
            @error('category')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品の状態 --}}
        <div>
            <label for="condition" class="block font-medium mb-2">商品の状態</label>
            <select name="condition" id="condition" class="w-full border border-gray-300 p-2 rounded">
                <option value="">選択してください</option>
                <option value="new">新品</option>
                <option value="used_like_new">未使用に近い</option>
                <option value="used_good">目立った傷や汚れなし</option>
                <option value="used_fair">やや傷や汚れあり</option>
                <option value="used_poor">全体的に状態が悪い</option>
            </select>
            @error('condition')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品名 --}}
        <div>
            <label for="name" class="block font-medium mb-2">商品名</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 p-2 rounded" value="{{ old('name') }}">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- ブランド名 --}}
        <div>
            <label for="brand" class="block font-medium mb-2">ブランド名</label>
            <input type="text" name="brand" id="brand" class="w-full border border-gray-300 p-2 rounded" value="{{ old('brand') }}">
            @error('brand')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品の説明 --}}
        <div>
            <label for="description" class="block font-medium mb-2">商品の説明</label>
            <textarea name="description" id="description" rows="5" class="w-full border border-gray-300 p-2 rounded">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 価格 --}}
        <div>
            <label for="price" class="block font-medium mb-2">価格（円）</label>
            <input type="number" name="price" id="price" class="w-full border border-gray-300 p-2 rounded" value="{{ old('price') }}" min="0">
            @error('price')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- 出品ボタン --}}
        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">出品する</button>
        </div>
    </form>
</div>
@endsection