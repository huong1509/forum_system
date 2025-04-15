<?php
$title = 'Edit Module';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

include BASE_PATH . '/includes/DatabaseConnection.php';
include BASE_PATH . '/includes/DatabaseFunction.php';

if(isset($_POST['btn_edit_module'])){

    if (empty(trim($_POST['new_module']))) {
        $_SESSION['status'] = 'All fields are mandatory!';
        header('location: module-manage-code.php');
        exit();
    } else {
        $check_module = checkModule($pdo, $_POST['new_module']);

        if ($check_module > 0) {
            $_SESSION['status'] = 'Module already exist!';
            header('location: module-manage-code.php');
            exit();
        } else{

            $run = updateModule($pdo,$_POST['module_id'] ,$_POST['new_module']);
            if($run) {
                $_SESSION['status'] = 'Edit module successful!';
                header('location: module-manage-code.php');
                exit();
            } else {
                $_SESSION['status'] = 'Something went wrong!';
                header('location: module-manage-code.php');
                exit();
            }
        }
    }
} else {
    $module = getModule($pdo, $_GET['id']);
}

include BASE_PATH . '/templates/admin-temp/module-edit.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/admin-layout.html.php';
?>