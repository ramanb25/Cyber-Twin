<?php
        session_start();
        include('class_operator.php');
        $operator= new Operator();
        $operator->is_operator_login();
        
        $table = $_POST['table'];
        $extra = json_decode($_POST['extra'],true);
        
        $result=$operator->start_event($table,$extra);
        
        echo json_encode($result);
?>
