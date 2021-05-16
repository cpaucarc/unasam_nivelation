<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "RanksModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $min = intval($_POST['min']);
    $rankDimensionID = intval($_POST['rankDimensionID']);

    if (isset($min) and isset($rankDimensionID) and $rankDimensionID > 0) {
        $ranksModel = new RanksModel();
        $rsp = $ranksModel->updateDimensionRankValues($rankDimensionID, $min);
        if ($rsp) {
            echo (new SendMessage("Valores modificados con exito", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo en error", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Error, faltan datos $min $rankDimensionID", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error: " . $e->getMessage(), false))->getEncodedMessage();
}