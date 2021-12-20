<?php

        error_reporting(~E_WARNING & ~E_NOTICE);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $contactno = $_POST['contactno'];
        $email = $_POST['email'];  
        $address=$_POST['address']; 
        // print_r($_POST);
        // exit;
        
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
        
                if ($fname == "" || $lname == "" || $contactno =="" || $email == "" || $address == "" ){
                    $data = array(
                        'status' => 'failed',
                        'message' => "Error: "
                    );
                            }
                        else{
                        $sql= "INSERT INTO `tblusers`(`ID`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Address`) VALUES 
						(NULL,'$fname','$lname','$contactno','$email','$address')";
                         if (mysqli_query($conn, $sql)) { 
                                 $data = array(
                        'status' => 'success',
                        'message' => 'successfully inserted'
                        );
                             //echo "Thank you for the responce, We will contact you soon";
                                } else {
                                    $data = array(
                                        'status' => 'failed',
                                        'message' => "Error2: " . $sql . "<br>" . mysqli_error($conn)
                                    );
                         //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                 }
                            }
                            
                        mysqli_close($conn);
                       
            }
    $result = json_encode(array("data" => $data));
    echo $result;

    
?>