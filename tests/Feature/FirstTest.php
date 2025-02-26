<?php

test('First Test', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});
