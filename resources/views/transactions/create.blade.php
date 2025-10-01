@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    <h1 class="text-2xl font-bold mb-6">家計簿を登録</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- 日付 --}}
        <div>
            <label for="date" class="block font-medium">日付</label>
            <input type="date" id="date" name="date"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('date', date('Y-m-d')) }}" required>
        </div>

        {{-- カテゴリ --}}
        <div>
            <label for="category_id" class="block font-medium">カテゴリ</label>
            <select id="category_id" name="category_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type }})</option>
                @endforeach
            </select>
        </div>

        {{-- 金額 --}}
        <div>
            <label for="amount" class="block font-medium">金額</label>
            <input type="number" id="amount" name="amount"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('amount') }}" required>
        </div>

        {{-- メモ --}}
        <div>
            <label for="note" class="block font-medium">メモ</label>
            <input type="text" id="note" name="note"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('note') }}">
        </div>

        <div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                登録する
            </button>
        </div>
    </form>
</div>
@endsection
