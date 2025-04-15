<?php
$title = 'Add Module';
session_start();

include dirname(__DIR__, 2) . '/includes/config.php';

ob_start();

if(isset($_POST['btn_add_module'])){
    include BASE_PATH . '/includes/DatabaseConnection.php';
    include BASE_PATH . '/includes/DatabaseFunction.php';

    $module = $_POST['module_name'];


    if (empty(trim($module))) {
        $_SESSION['status'] = 'All fields are mandatory!';
    }else {
        
        $check_module = checkModule($pdo, $module);
        if ($check_module > 0) {
            $_SESSION['status'] = 'Module already exist!';
        } else{
            $run = addModule($pdo, $module);

            if($run){
                $_SESSION['status'] = 'Add user successfull!';
                header('location: module-manage-code.php');
                exit();
            } else{
                $_SESSION['status'] = 'Add module failed!';
            }
        } 
    }
}

include BASE_PATH . '/templates/admin-temp/module-add.html.php';
$output = ob_get_clean();
include BASE_PATH . '/templates/admin-layout.html.php';
?>