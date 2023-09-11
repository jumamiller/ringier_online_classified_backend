<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login(): void
    {
        $response = $this->post('/api/v1/login', [
            'email' => 'admin@example.com',
            'password' => 'Password123!'
        ]);
        //
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
