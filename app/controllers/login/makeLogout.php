<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "sessions/SessionStarted.php");
session_start();
session_destroy();
(new SessionStarted())->redirectToLoginView();
