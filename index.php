<?php
error_reporting(~E_WARNING & ~E_NOTICE);
include('dbconnection.php');
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql=mysqli_query($con,"delete from tblusers where ID=$rid");
echo "<script>alert('Data deleted');</script>"; 
echo "<script>window.location.href = 'index.php'</script>";     
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Elegant Table Design</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">

</head>
<body>

<div class="signup-form">
    <form  method="POST">
    <div class="status" style="color: red; text-align: center"></div>
<?php
$eid=$_GET['editid'];
if($eid == 0){?>
		<h2>Fill Data</h2>
		<p class="hint-text">Fill below form.</p>
        <input type="hidden" class="form-control" name="action" id="action"  value="add">
        <div class="form-group">
			<div class="row">
				<div class="col"><input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" ></div>
				<div class="col"><input type="text" class="form-control" name="lname" id="lname"  placeholder="Last Name" ></div>
			</div>        	
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="contactno" id="contactno"  placeholder="Enter your Mobile Number" maxlength="10" pattern="[0-9]+">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email"  id="email"  placeholder="Enter your Email id" >
        </div>
		
		<div class="form-group">
            <textarea class="form-control" name="address" id="address"  placeholder="Enter Your Address"></textarea>
        </div>        
      
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
        </div>
    <?php
    }else
    {
        $ret=mysqli_query($con,"select * from tblusers where ID='$eid'");
        while ($row=mysqli_fetch_array($ret)) {
        ?>
                <h2>Update </h2>
                <input type="hidden" class="form-control" name="action" id="action"  value="edit">
                <input type="hidden" class="form-control" name="recid" id="recid"  value="<?php  echo $eid;?>">
                <p class="hint-text">Update your info.</p>
                <div class="form-group">
                    <div class="row">
                        <div class="col"><input type="text" class="form-control" name="fname" id="fname"  value="<?php  echo $row['FirstName'];?>"></div>
                        <div class="col"><input type="text" class="form-control" name="lname" id="lname"  value="<?php  echo $row['LastName'];?>"></div>
                    </div>        	
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="contactno" id="contactno"  value="<?php  echo $row['MobileNumber'];?>"maxlength="10" pattern="[0-9]+">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email"  value="<?php  echo $row['Email'];?>">
                </div>
                
                <div class="form-group">
                    <textarea class="form-control" name="address" id="address"  required="true"><?php  echo $row['Address'];?></textarea>
                </div>        
              <?php 
        }?>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submit" >Update</button>
                </div>

                <?php 
        }?>
    </form>	
</div>

<div id="delrecords" class="delrecords"></div>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>User <b>Management</b></h2>                   
                    </div>            
                <div id="showrecords" class="showrecords"></div>
            </div>
        </div>
    </div> 
</div> 
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>User <b>Details</b></h2>
                    </div>
                </div>
            </div>
<table cellpadding="0" cellspacing="0" class="display table table-bordered" id="hidden-table-info">
               
<tbody>
<?php
$vid=$_GET['viewid'];
$ret=mysqli_query($con,"select * from tblusers where ID =$vid");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
 <tr>
    <th>First Name</th>
    <td><?php  echo $row['FirstName'];?></td>
    <th>Last Name</th>
    <td><?php  echo $row['LastName'];?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php  echo $row['Email'];?></td>
    <th>Mobile Number</th>
    <td><?php  echo $row['MobileNumber'];?></td>
  </tr>
  <tr>
    <th>Address</th>
    <td><?php  echo $row['Address'];?></td>
    <th>Creation Date</th>
    <td><?php  echo $row['CreationDate'];?></td>
  </tr>
<?php 
$cnt=$cnt+1;
}?>
                 
</tbody>
</table>
       
        </div>
    </div>
</div>   
<script>


function showRecords() {

    
    fetch("show.php", { method: "GET" })
                .then((response) => response.json())
                .then(function (data) {
                    document.querySelector("#showrecords").innerHTML =data.data.htmldata;
                })

}
    const formEl = document.forms[0];

 showRecords();

            formEl.addEventListener("submit", function(event) {
            event.preventDefault();   
            var formData = new FormData();
            for (var i = 0; i < formEl.length; ++i) {
                formData.append(formEl[i].name, formEl[i].value);}
                console.log(formData);

                let actionData = document.getElementById("action").value;
                if(actionData == "add") {
                 fetch("create.php", { method: "POST", body: formData })
                .then((response) => response.json())
                .then(function (data) {
                    console.log(typeof data);
                    //var parsedData  = JSON.parse(data);
                    var parsedData = data;
                    console.log(parsedData);
                    var receivedData = parsedData.data;

                    if (receivedData.status == "success") {
                    document.querySelector(".status").innerHTML =receivedData.message;
                    document.getElementById("fname").value="";
                    document.getElementById("lname").value="";
                    document.getElementById("contactno").value="";
                    document.getElementById("email").value="";
                    document.getElementById("address").value="";
                    showRecords();
                    
                    }
                    document.querySelector(".status").innerHTML = receivedData.message;
                })

                .catch((error) => {
                    console.error("Error:", error);
                
                });
                        }else if(actionData == "edit"){
                            fetch("update.php", { method: "POST", body: formData })
                .then((response) => response.json())
                .then(function (data) {
                    console.log(typeof data);
                    //var parsedData  = JSON.parse(data);
                    var parsedData = data;
                    console.log(parsedData);
                    var receivedData = parsedData.data;

                    if (receivedData.status == "success") {
                    document.querySelector(".status").innerHTML =receivedData.message;
                    $eid=0;
                    showRecords();
                    }
                    document.querySelector(".status").innerHTML = receivedData.message;
                })

                .catch((error) => {
                    console.error("Error:", error);
                
                });

                        }

                })      
    </script>
 
</body>
</html>