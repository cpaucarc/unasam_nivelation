<?php
session_start();
echo $_SESSION['files']['filepath'] ?? "";

