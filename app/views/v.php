<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once MODEL_PATH . "UserModel.php";

$user = new UserModel();
$user->setGenderID(1);
var_dump($user->getGender());

echo $_POST['gender']
?>

<form action="v.php" method="post">
    <label for="user_dni">Género</label>
    <select name="gender" id="gender" class="form-control" required>
        <option value="0">Seleccione...</option>
        <option value="1">Femenino</option>
        <option value="2">Masculino</option>
    </select>
    <button type="submit">Submit</button>
</form>

