<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
        <h1 class="text-2xl font-bold mb-6">家計簿の履歴</h1>

        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border-b p-2">日付</th>
                    <th class="border-b p-2">カテゴリ</th>
                    <th class="border-b p-2">種類</th>
                    <th class="border-b p-2">金額</th>
                    <th class="border-b p-2">メモ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="border-b p-2">{{ $transaction->date }}</td>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">記録がありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
</x-app-layout>
