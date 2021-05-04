<?php
session_start();
echo $_SESSION['login']['error'];
echo '<br>';
var_dump($_SESSION['login']);