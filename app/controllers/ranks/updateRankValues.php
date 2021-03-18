<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "RanksModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $min = intval($_POST['txMin']);
    $max = intval($_POST['txMax']);
    $rankID = intval($_POST['rankID']);

    if (isset($min) and isset($max) and isset($rankID) and $rankID > 0) {
        $ranksModel = new RanksModel();
        $ranksModel->setId($rankID);
        $ranksModel->setMaximum($max);
        $ranksModel->setMinimal($min);
        $ranksModel->updateRankValues();
        echo (new SendMessage("Valores modificados con exito", true))->getEncodedMessage();
    } else {
        echo (new SendMessage("Error, faltan datos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}