<?php
include_once 'models/interv.php';
include_once 'util/dates.php';
include_once 'models/tech_arrays.php';

if (isset($_POST['affecter_a'])) {
    $matricule = $_POST['affecter_a'] != "" ? $_POST['affecter_a'] : null;
    $success = affecter_a($_GET['id'], $matricule);
    if (!$success) {
        header("Location: $uri?id=$_GET[id]&error=1");
        die();
    }
    header("Location: $uri?id=$_GET[id]");
}

$error="";
if(isset($_GET['error'])){
    switch($_GET['error']){
        case 1:
            $error = "Choisissiez un technicien valide.";
            break;
    }
}

$interv = get_intervention_by_id($_GET['id']);
$all_tech = get_techniciens_agence($interv['code_agence'], 'nom');
include 'views/admin/interv_details.php';
