<?php

use App\Models\User;


it('has transaction page', function () {
    $response = $this->get('/transaction');

    $response->assertStatus(200);
});
