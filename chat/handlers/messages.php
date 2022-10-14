<?php
include ('../../auth/dbconnection.php');

include ('../config.php');
session_start();

switch ($_REQUEST['action']){
    case "sendMessage":
        //echo 'sending response back from php page';
        //global $pdo;
     
        $cur_date = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("SELECT * FROM patients WHERE email=?");
        $stmt->bind_param("s", $_REQUEST['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) ;
        while($row = $result->fetch_assoc()) {
          
          $email = $row['email'];
          $p_id = $row['p_id'];

        }


        
        $query2 = $pdo->prepare("INSERT INTO chat SET user_id=?, p_id=?, message=?,date=?,sent_by=? ");
        $row2 = $query2->execute([$_SESSION['user_id'], $p_id, $_REQUEST['message'],$cur_date,$_SESSION['user_id']]);

        if ($row2){
            echo 1;
            exit;
        }else{
            echo "dfdfd";
    
        }

        break;

        

    case "getMessages":

        
        $stmt = $conn->prepare("SELECT * FROM patients WHERE email=?");
        $stmt->bind_param("s", $_REQUEST['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) ;
        while($row = $result->fetch_assoc()) {
          
          $email = $row['email'];
          $p_id = $row['p_id'];

        
        //echo 'working';

        $query=$pdo->prepare("SELECT * FROM chat WHERE user_id= '".$_SESSION['user_id']."' AND p_id= '".$row['p_id']."' ORDER BY date ASC");
        $row=$query->execute();
        $rs=$query->fetchAll(PDO::FETCH_OBJ);
        //echo var_dump($rs);
        
    $chat='';
    foreach ($rs as $messages){
        $sent_by=$messages->sent_by;

        //$chat.=$message->message.'<br>';
        if($sent_by==$_SESSION['user_id'] ){

        $chat .= 
    
        '<div class="message right">
        <div class="bubble">
        '.$messages->message.'
            <div class="corner"></div>
            <br> <span>'.$messages->date.'</span>
        </div>
    </div> <br> <br>';

} else{

       
    $chat .= 
        

    '<div class="message">
    <div class="bubble">
    '.$messages->message.'
       <div class="corner"></div>
       <br>   <span>'.$messages->date.'</span>
    </div>
</div> <br> <br>';


    
}


    }
    echo $chat;
        break;
}

}
?>