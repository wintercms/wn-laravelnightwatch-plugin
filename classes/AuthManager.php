<?php

namespace Winter\LaravelNightwatch\Classes;

use Backend\Classes\AuthManager as BackendAuthManager;

class AuthManager extends BackendAuthManager
{
    public function hasResolvedGuards()
    {
        return true;
    }
}
