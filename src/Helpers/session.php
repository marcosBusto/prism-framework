<?php

use Prism\Session\Session;

function session(): Session
{
    return app()->session;
}
