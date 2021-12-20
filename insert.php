<?php

$json = file_get_contents('php://input');
$data = json_decode($json);


        // $id=$data->eid;
        $fname = $data->fname;        
        $lname = $data->lname;        
        $contactno = $data->contactno;
        $email = $data->email;
        $address = $data->address;
        
        
        $error=false;
        $errmsg = "";

        if($fname == "" ){
           
            $errmsg = "First Name is empty";
            $error = true;
        }
        if($lname == "" ){
            $errmsg = $errmsg. "<br>Last Name is empty";
            $error = true;
        }
        if($contactno == ""){           
            $errmsg = $errmsg . "<br>Contact Number is empty";
            $error = true;
        }
        if($email == ""){
            $errmsg = $errmsg . "<br>Email is empty";
            $error = true;
        }
        if($address == ""){            
            $errmsg = $errmsg . "<br>Address is empty";
            $error = true;
        }      

        if($error){
            $data = array(
                'status' => 'failed',
                'message' => $errmsg
            );
        }else{
                //insertion();
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "phpcrud";
        
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
        
                if ($name == "" || $email == "" || $subject =="" || $message == "" ){
                    $data = array(
                        'status' => 'failed',
                        'message' => "Error: " . $sql . "<br>" . mysqli_error($conn)
                    );
                            }
                        else{
                        $sql= "INSERT INTO `tblusers`(`ID`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Address`, `CreationDate`) VALUES 
						(NULL,'$fname','$lname','$contactno',[value-5],[value-6],[value-7])";
                            }
                             if (mysqli_query($conn, $sql)) { 
                                 $data = array(
                        'status' => 'success',
                        'message' => 'successfully inserted'
                        );
                             //echo "Thank you for the responce, We will contact you soon";
                                } else {
                                    $data = array(
                                        'status' => 'failed',
                                        'message' => "Error: " . $sql . "<br>" . mysqli_error($conn)
                                    );
                         //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                 }
                        mysqli_close($conn);
                       
            }
    $result = json_encode(array("data" => $data));
    echo $result;

    
?>