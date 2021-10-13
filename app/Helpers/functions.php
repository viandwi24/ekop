<?php

use Illuminate\Support\Facades\Auth;

function auth_check($guard = null) {
    $resultGuard = current_guard();
    if ($guard != null) return ($resultGuard == $guard);
    if ($resultGuard != 'guest') return true;
    return false;
}

function current_guard() {
    if (Auth::guard('cooperative')->check()) {
        return 'cooperative';
    } elseif (Auth::guard('web')->check()) {
        return 'web';
    } else {
        return 'guest';
    }
}

function current_auth() {
    if (current_guard() == 'cooperative') {
        return Auth::guard('cooperative')->user();
    } elseif (current_guard() == 'web') {
        return Auth::guard('web')->user();
    } else {
        return null;
    }
}
