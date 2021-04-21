<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "DimensionModel.php");
require_once(UTIL_PATH . "SendMessage.php");

$dimension = new DimensionModel();
echo($dimension->getAllDimensions());