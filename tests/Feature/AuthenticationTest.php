<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('it can redirect back if the user is not logged in', function (): void {
    $this->get(route('dashboard'))->assertRedirectToRoute('login');
});

test('it can render register inertia component', function (): void {
    $this->get(route('register'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Register'));
});

test('it can render the login inertia component', function (): void {
    $this->get(route('login'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

test('it can throw error because credentials is not matched', function (): void {
    $this->post(route('login'), [
        'email' => 'utsav@gmail.com',
        'password' => 'Pass@123',
        'remember_me' => false,
    ])
        ->assertRedirect()
        ->assertSessionHasErrors(['email' => __('auth.failed')]);
});

test('it can register', function (): void {
    $this->post(route('register'), [
        'name' => 'Utsav Somaiya',
        'email' => 'utsavsomaiya4464@gmail.com',
        'password' => 'Pass@123',
        'password_confirmation' => 'Pass@123',
    ])
        ->assertRedirectToRoute('dashboard');

    $this->assertAuthenticated();
    $this->assertDatabaseCount(User::class, 1);
});

test('it can login', function (): void {
    $user = User::factory()->create([
        'email' => 'utsavsomaiya4464@gmail.com',
        'password' => 'Pass@123',
    ]);

    $this->post(route('login'), [
        'email' => 'utsavsomaiya4464@gmail.com',
        'password' => 'Pass@123',
    ])
        ->assertRedirectToRoute('dashboard');

    $this->assertAuthenticatedAs($user);
});
