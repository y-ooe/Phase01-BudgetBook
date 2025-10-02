<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 家計簿の履歴を表示する
        $transactions = Transaction::where('user_id', auth()->id())
            ->with('user')
            ->latest()
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        // カテゴリ一覧を取得して登録画面に渡す
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // バリデーション
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'amount' => ['required', 'integer', 'min:1'], // 1以上の整数
            'transaction_date' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $category = Category::findOrFail($validated['category_id']);
        
        // 支出の場合は金額をマイナスに変換
        if ($category->type === 'expense') {
            $validated['amount'] = -abs($validated['amount']);
        }
        
        $validated['type'] = $category->type;
        
        // 保存
        $request->user()->transactions()->create($validated);

        return redirect()->route('transactions.create')->with('success', '家計簿を登録しました');

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
        $categories = Category::all();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    $validated = $request->validate([
        'category_id' => ['required', 'exists:categories,id'],
        'amount' => ['required', 'integer', 'min:1'],
        'transaction_date' => ['required', 'date'],
        'note' => ['nullable', 'string', 'max:255'],
        ]);

        $category = Category::findOrFail($validated['category_id']);
        
        // 支出の場合は金額をマイナスに変換
        if ($category->type === 'expense') {
            $validated['amount'] = -abs($validated['amount']);
        }
        $validated['type'] = $category->type;

        $transaction->update($validated);

        return redirect()->route('transactions.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // 家計簿を削除
        $transaction->delete();

        return redirect()->route('transactions.index');
    }
}
