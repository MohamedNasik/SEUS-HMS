<?php
    include "dbconnection.php";
    session_start();
    if (isset($_POST['email'])  && isset($_POST['password']) ) {
        //i dont see your password colom name, so i guess it password
        if ($stmt = mysqli_prepare($conn, "SELECT user_id,role_id,fname,lname FROM users WHERE email=? AND password=?")) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$user_id,$role_id,$fname,$lname);

            mysqli_stmt_fetch($stmt);
            $username = $fname . ' ' . $lname;

            $_SESSION['user_id']=$user_id;
            $_SESSION['usernames']=$username;
            $_SESSION['role_id']=$role_id;

            mysqli_stmt_close($stmt);
        }

        $sql = "SELECT * FROM roles WHERE role_id = '".$role_id."' ";
        if($result = mysqli_query($conn,$sql));
         if($result){
            while($row = mysqli_fetch_array($result)){
    
             //echo $row['role_id'];
             echo $row['role_name'];
        
        
        }
     if($row['role_id']==$role_id){
    
        //  echo 'welcome';
    
     }
        }

    }

    echo false;


?>