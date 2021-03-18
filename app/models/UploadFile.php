<?php
$temporary_file=$_FILES['file']['tmp_name'];
$name =$_FILES['file']['name'];
move_uploaded_file($temporary_file,'../../others/documents/'.$name);
