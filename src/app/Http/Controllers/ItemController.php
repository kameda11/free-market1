<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Models\Favorite;
use App\Models\Address;
use App\Models\Purchase;
use App\Models\Comment;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function add(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity', 1);

        // 商品情報を取得
        $item = Exhibition::findOrFail($itemId);

        // セッションからカートを取得（なければ空の配列）
        $cart = session()->get('cart', []);

        // すでにカートにある場合は数量を追加
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $quantity;
        } else {
            // カートに追加
            $cart[$itemId] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'image' => $item->product_image,
                'quantity' => $quantity,
            ];
        }

        // カートをセッションに保存
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'カートに追加しました。');
    }

    public function index()
    {
        $allExhibitions = Exhibition::all();
        $favoriteExhibitions = Exhibition::whereIn('id', function ($query) {
            $query->select('exhibition_id')
                ->from('favorites')
                ->where('user_id', Auth::id());
        })->get();
        return view('index', compact('allExhibitions', 'favoriteExhibitions'));
    }

    public function confirm(PurchaseRequest $request)
    {
        $product = Exhibition::findOrFail($request->item_id);
        $quantity = $request->quantity;
        $user = auth()->user();

        // ユーザーの住所を取得（ここでは1件仮定）
        $address = Address::first(); // 実際はuser_idなどで取得

        session([
            'purchase_item_id' => $product->id,
            'purchase_quantity' => $quantity,
        ]);


        return view('purchase', compact('product', 'quantity', 'address'));
    }

    public function create()
    {
        return view('sell'); // sell.blade.phpを表示
    }

    public function store(ExhibitionRequest $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        // バリデーション済みデータを取得
        $validated = $request->validated();

        // DBに保存する形式に加工
        if (isset($path)) {
            $validated['product_image'] = $path; // カラム名に合わせる
        }

        $validated['user_id'] = auth()->id();

        // ユーザーIDも追加（もし必要なら）
        $validated['user_id'] = auth()->id();

        // 商品を保存
        Exhibition::create($validated);

        return redirect()->route('index')->with('success', '商品を出品しました！');
    }

    public function storeComment(CommentRequest $request)
    {
        Comment::create($request->validated());

        return back()->with('success', 'コメントを投稿しました！');
    }

    public function show($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        return view('detail', compact('exhibition'));
    }
}
