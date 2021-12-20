<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpcrud";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }


$tableHeader = '
<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>                       
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
            
                    
                    $ret=mysqli_query($con,"select * from tblusers");
                    $cnt=1;
                    $row=mysqli_num_rows($ret);
                    $tableRow = "";
                    if( $row > 0 )
                    {
                    while ($row=mysqli_fetch_array($ret)) {

                   

$tableRow = $tableRow."<tr>
                        <td>".$cnt."</td>
                        <td>".$row['FirstName']." ".$row['LastName']."</td>
                        <td>".$row['Email']."</td>                        
                        <td>".$row['MobileNumber']."</td>
                        <td>".$row['CreationDate']."</td>
                        <td>
  <a href='index.php?viewid=".$row['ID']."' class='view' title='View' data-toggle='tooltip'><i class='material-icons'>&#xE417;</i></a>
                            <a href='index.php?editid=".$row['ID']."' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                            <a href='index.php?delid=".$row['ID']."' class='delete' title='Delete' data-toggle='tooltip' onclick='return confirm('Do you really want to Delete ?');'>
                            <i class='material-icons'>&#xE872;</i></a>
                        </td>
                    </tr>";
                   
$cnt=$cnt+1;
} } else {
$tableRow = '<tr>
    <th style="text-align:right; color:red;" colspan="6">No Record Found</th>
</tr>';
 }                 
                
 $returnData =  $tableHeader.$tableRow.'</tbody>
            </table>';

            
            $data = array(
                'status' => 'success',
                'htmldata' =>  $returnData
            );

            $result = json_encode(array("data" => $data));
            echo $result;
        
?>   