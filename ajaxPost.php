<?php require_once('config.php');
$allData = $_POST['allData'];
$i = 1;
foreach ($allData as $key => $value) {
    $sql = "UPDATE sorting_record SET display_order=".$i." WHERE id=".$value;
    $mysqli->query($sql);
    $i++;
}
