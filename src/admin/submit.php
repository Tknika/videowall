<?php
/*
 * This simple script will receive a JSON by POST
 * and it will save it in a file (../events.json)
 *
 * WARNING! Is highly recommended to protect this
 * folder with a htpassword
 */

$data = json_decode(file_get_contents('php://input'), true);
if (file_put_contents("../events.json", json_encode($data))){
    echo "ok";
} else {
    echo "error";
}
?>
