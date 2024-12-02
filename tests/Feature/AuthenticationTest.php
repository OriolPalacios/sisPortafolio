<?php

uses(RefreshDatabase::class);

test('registrar un usuario', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
