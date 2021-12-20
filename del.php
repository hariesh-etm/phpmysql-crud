<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpcrud";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$con) {
                die("Connection failed: " . mysqli_connect_error());  }
         
                    
                $rid=intval($_GET['delid']);
                $sql=mysqli_query($con,"delete from tblusers where ID=$rid");        
                
 $returnData =  "index.php";
            
            $data = array(
                'status' => 'success',
                'htmldata' =>  $returnData
            );

            $result = json_encode(array("data" => $data));
            echo $result;
        
?>   
