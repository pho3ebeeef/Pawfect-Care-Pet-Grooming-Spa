<?php

protected function redirectTo()
{
    $role = auth()->user()->role;

    switch ($role) {
        case 'admin':
            return '/admin/dashboard';
        case 'groomer':
            return '/groomer/dashboard';
        case 'client':
            return '/client';
        default:
            return '/';
    }
}