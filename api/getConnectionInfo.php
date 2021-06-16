<?php

include "class.Information.php";

$information = new Information();
if (@$_POST["one"] == "true") {
    $fetch = $information->getConnectionInfoWithUserName(@$_POST["userName"]);
    $array = array("connection" => $fetch);
    echo json_encode($array);
} else if (@$_POST["one"] == "false") {
    $fetch = $information->getConnectionInfoAll();
    echo json_encode($fetch);
}

