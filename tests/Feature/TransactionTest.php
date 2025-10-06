<?php

use App\Models\User;
use App\Models\Transaction;
use App\Models\Category;


// it('has transaction page', function () {
//     $response = $this->get('/transaction');

//     $response->assertStatus(200);
// });

it('can create a transaction', function() {
    $this->seed(CategorySeeder::class); // カテゴリを投入

    //ユーザー作成
    $user = User::factory()->create();

    // ユーザーを認証
    $this->actingAs($user);

    // 作成するデータを用意
    $transactionData = [
        'category_id' => 7,
        'amount' => 1000,
        'transaction_date' => '2024-01-01',
        'note' => 'Test transaction',
    ];

    // POSTリクエストを送る
    $response = $this->post('/transactions', $transactionData);


    // DBを確認
    $this->assertDatabaseHas('transactions', $transactionData);

    // レスポンス確認
    $response->assertStatus(302);

});