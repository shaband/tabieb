<?php

namespace App\Services\Contracts;

use OpenTok\OpenTok;
use OpenTok\OutputMode;
use OpenTok\Session;
use OpenTok\Role;

interface TokBoxContract
{
    public function getSession($sessionId, $options = array()): Session;

    public function defaultSession(?array $options = []): Session;

}
