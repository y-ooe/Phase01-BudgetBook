<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
        <h1 class="text-2xl font-bold mb-6">家計簿の履歴</h1>

        <!-- 集計結果 -->
        <div class="grid grid-cols-3 gap-4 text-center mb-6">
            <div class="p-4 bg-green-100 rounded-lg">
                <div class="text-lg font-semibold text-green-700">収入合計</div>
                <div class="text-2xl font-bold text-green-800">
                    {{ number_format($incomeTotal) }} 円
                </div>
            </div>
            <div class="p-4 bg-red-100 rounded-lg">
                <div class="text-lg font-semibold text-red-700">支出合計</div>
                <div class="text-2xl font-bold text-red-800">
                    {{ number_format($expenseTotal) }} 円
                </div>
            </div>
            <div class="p-4 bg-blue-100 rounded-lg">
                <div class="text-lg font-semibold text-blue-700">差引残高</div>
                <div class="text-2xl font-bold text-blue-800">
                    {{ number_format($balance) }} 円
                </div>
            </div>
        </div>

        <!-- 履歴テーブル -->
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border-b p-2">日付</th>
                    <th class="border-b p-2">カテゴリ</th>
                    <th class="border-b p-2">種類</th>
                    <th class="border-b p-2">金額</th>
                    <th class="border-b p-2">メモ</th>
                    <th class="border-b p-2 text-center">操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="border-b p-2">{{ $transaction->transaction_date }}</td>
                        <td class="border-b p-2">{{ $transaction->category->name }}</td>
                        <td class="border-b p-2">
                            @if($transaction->type === 'income')
                                <span class="text-green-600 font-semibold">収入</span>
                            @else
                                <span class="text-red-600 font-semibold">支出</span>
                            @endif
                        </td>
                        <td class="border-b p-2">{{ number_format($transaction->amount) }} 円</td>
                        <td class="border-b p-2">{{ $transaction->note }}</td>
                        <td class="border-b p-2 text-center flex justify-center space-x-2">
                            <a href="{{ route('transactions.edit', $transaction) }}" 
                               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                編集
                            </a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" 
                                  onsubmit="return confirm('削除してもよろしいですか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                    削除
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">記録がありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
