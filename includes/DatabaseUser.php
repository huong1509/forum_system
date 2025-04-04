<?php

function query($pdo, $sql,$parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}


?>