<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
        <h1 class="text-2xl font-bold mb-6">家計簿を登録</h1>

        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="transaction_date" class="block font-medium">日付</label>
                <input type="date" id="transaction_date" name="transaction_date"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('transaction_date', date('Y-m-d')) }}" required>
            </div>

            <div>
                <label for="category_id" class="block font-medium">カテゴリ</label>
                <select id="category_id" name="category_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="amount" class="block font-medium">金額</label>
                <input type="number" id="amount" name="amount"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('amount') }}" required>
            </div>

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
        <!-- 成功したらメッセージ表示 -->
        @if (session('success'))
            <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif
    </div>
</x-app-layout>
