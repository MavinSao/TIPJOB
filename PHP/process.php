<?php

    session_start();

    $db = new mysqli('localhost','root','','interview','3306') or die(mysqli_error($mysqli));

    if($db->connect_errno)
    echo "Error Number: $db->connect_errno Error Message: $db->connect_error";
    else{
        //Add Question
        if (isset($_POST['save'])) {
            $question_detail = $_POST['question'];
            $create_date = $_POST['create-date'];
            $insert="INSERT INTO question(question_detail,create_date) VALUE ('$question_detail','$create_date')";  
            if ($db->query($insert)==true){
                $_SESSION['message'] = "Question has been add!";
                $_SESSION['msh_type'] = "success";

                header("location: question.php?limit=10&&offset=0");
            }
        }    
    }
    //Delete Question
    if (isset($_GET['delete'])) {
            $delete_id = $_GET['delete'];
            $delete="DELETE FROM `question` WHERE `question`.`question_id` = $delete_id";  
            if ($db->query($delete)==true) {
                $_SESSION['message'] = "Question has been delete!";
                $_SESSION['msg_type'] = "success";

                header("location: question.php?limit=10&&offset=0");
            }         
            else echo "error";    
    }
    //Update Question
    if (isset($_POST['update'])){
        $question_id = $_POST['id'];
        $question_detail = $_POST['question'];
        $create_date = $_POST['create-date'];
        $update="UPDATE question SET question_detail='$question_detail', create_date='$create_date' WHERE question_id=$question_id";
        if ($db->query($update)==true){
            $_SESSION['message'] = "Update Success!";
            $_SESSION['msg_type'] = "success";
            header("location: question.php?limit=10&&offset=0");
        }
    }
    //Add Answer
    if(isset($_POST['answer'])){
        $answer_detail = $_POST['answer_detail'];
        $question_id = $_POST['question_id'];
        $create_date = $_POST['create-date'];
        $insertAnswer="INSERT INTO answer(answer_detail,question_id,create_date) VALUE ('$answer_detail','$question_id','$create_date')";
        if ( $db->query($insertAnswer)==true){
            $_SESSION['message'] = "Add Success!";
            $_SESSION['msg_type'] = "success";
            header("location: answer.php?question_id=$question_id&&limit=5&&offset=0");
        }else{
            echo "fale";
        }

    }

    //Update Answer
    if (isset($_POST['update_answer'])) {
            $question_id = $_POST['question_id'];
            $answer_id = $_POST['answer_id'];
            $answer_detail = $_POST['answer_detail'];
            $create_date = $_POST['create-date'];
            $update="UPDATE answer SET answer_detail='$answer_detail', create_date='$create_date', question_id='$question_id' WHERE answer_id=$answer_id";
            if ($db->query($update)==true) {
                $_SESSION['message'] = "Update Success!";
                $_SESSION['msg_type'] = "success";
                header("location: answer.php?question_id=$question_id&&limit=5&&offset=0");
            } else {
                echo 'false';    
            }
    }

    //Delete Answer
    if (isset($_GET['delete_answer'])) {
        $delete_id = $_GET['delete_answer'];
        $question_id = $_GET['question_id'];
        $delete="DELETE FROM answer WHERE answer_id = $delete_id";  
        if ($db->query($delete)==true) {
            $_SESSION['message'] = "Answer has been delete!";
            $_SESSION['msg_type'] = "success";

            header("location: answer.php?question_id=$question_id&&limit=5&&offset=0");
        }         
        else echo "error";    
}
    

    

   

?>