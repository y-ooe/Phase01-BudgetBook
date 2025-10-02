<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">取引の編集</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="transaction_date" class="block text-sm font-medium">日付</label>
                <input type="date" name="transaction_date" id="transaction_date"
                       value="{{ old('transaction_date', $transaction->transaction_date) }}"
                       class="border rounded w-full p-2">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium">カテゴリ</label>
                <select name="category_id" id="category_id" class="border rounded w-full p-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium">金額</label>
                <input type="number" name="amount" id="amount"
                       value="{{ old('amount', abs($transaction->amount)) }}"
                       class="border rounded w-full p-2">
            </div>

            <div>
                <label for="note" class="block text-sm font-medium">メモ</label>
                <input type="text" name="note" id="note"
                       value="{{ old('note', $transaction->note) }}"
                       class="border rounded w-full p-2">
            </div>

            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">更新</button>
                <a href="{{ route('transactions.index') }}" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">戻る</a>
            </div>
        </form>
    </div>
</x-app-layout>
