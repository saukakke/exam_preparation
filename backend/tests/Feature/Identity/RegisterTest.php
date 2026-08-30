<?php

it('registers a user and returns an access token', function (): void {
    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'Test Student',
        'email' => 'student@example.test',
        'password' => 'SecurePassword123!',
        'password_confirmation' => 'SecurePassword123!',
    ]);

    $response->assertCreated()
        ->assertJsonPath('data.user.email', 'student@example.test')
        ->assertJsonStructure(['data' => ['user', 'token']]);

    $this->assertDatabaseHas('users', ['email' => 'student@example.test']);
});
