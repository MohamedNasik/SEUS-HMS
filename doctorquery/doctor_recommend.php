<?php

session_start();

// Include config file
require_once "../auth/dbconnection.php";

if (isset($_POST['doctor_name'])) {

    $stmt = $conn->prepare("SELECT * FROM doctor_specialist WHERE doctor_name=? ");
    $stmt->bind_param("s",$_POST["doctor_name"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
    
      $user_id = $row['user_id'];

    }
}
    
    if($stmt1 = mysqli_prepare($conn,"INSERT INTO doctor_recommend (user_id,specilization,p_id,description,recommended_by,submit_date) VALUES (?, ?, ?, ?, ?, ?)")){

        $doctor_name=$_POST["doctor_name"];
        $specilization=$_POST["specilization"];
        $p_id=$_POST["p_id"];
        $doc_description=$_POST["doc_description"];
        $recommended_by= $_SESSION['usernames'];
        $cur_date = date('Y-m-d');

        mysqli_stmt_bind_param($stmt1, "ssssss",$user_id,$specilization,$p_id,$doc_description,$recommended_by,$cur_date);

       echo $doctor_name;
   
      mysqli_stmt_execute($stmt1);

} else{

    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

}


}






?>



