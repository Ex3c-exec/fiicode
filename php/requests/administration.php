<?php
    
    //MESAJUL CU EROAREA RETURNAT
    function errorMsg($msg){
        $error = array("eroare" => $msg);
        echo JSON_encode($error);
    }

    // DACA NU PRIMIM UN ID, RETURNAM EROARE
    if(!empty($_POST['id'])){

        $id = $_POST['id'];
        $new_status = 0;
        include '../connect.php';
        
        // ACCEPTAM REQUESTUL CU ID-UL PRIMIT (SCHIMBAT STATUSUL IN 1)  
        if(isset($_POST['ACCEPT_REQ']))
            $new_status = 1;
        // REFUZAM REQUESTUL CU ID-UL PRIMIT (SCHIMBAT STATUSUL IN -1)
        else if(isset($_POST['DECLINE_REQ']))
            $new_status = -1;

        // UPDATAM IN STATUSUL REQUESTULUI
        $sql = "UPDATE request SET status='$new_status' WHERE id='$id'";
        if($conn->query($sql) === TRUE){
            $success = array("success" => "Success set status");
		    echo JSON_encode($success);
        }
        else 
            errorMsg("Eroare la update status");
    }
    else
        errorMsg("Eroare la trimiterea parametriilor");

    
    
?>