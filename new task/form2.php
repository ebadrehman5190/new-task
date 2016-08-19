<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="payment.css">
    <script src="http://localhost/php/newtask/payment_validation.js"></script>
</head>
<body>
    <div class="header-bar">
        <div class="header-option">
            <a href="Entry.php"></a>
        </div>
    </div>  
<?php

$data="";
$data['date']="";
$data['member']="";
$data['items']="";
$data['paid']="";
$data['amount']="";
$balance['SUM(per_head)']="";
$data['per_head']="";
$_POST['date']="";
$_POST['mpaid']="";
$_POST['member']="";
$_POST['select_member']="";
// define variables and set to empty values
$dateErr = $mSelectErr = $mpaidErr = $select_memberErr = "";
$date = $mpaid = $member = $select_member = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["date"])) {
    $dateErr = "Date is required";
  } else {
    $date = test_input($_POST["date"]);
  }
  
  if (empty($_POST["member"])) {
    $mSelectErr = "please select a member";
  } else {
    $member = test_input($_POST["member"]);
  }
  
  if (empty($_POST["mapid"])) {
    $mpaidErr = "please insert amount";
  } else {
    $mpaid = test_input($_POST["mpaid"]);
  }    
  
  if (empty($_POST['select_member'])) {
      $select_memberErr = "please select a member";
  } else {
      $select_member = test_input($_POST["select_member"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

    $conn = mysqli_connect('localhost','root','','test');
            mysqli_select_db($conn,"test");
            
    if($_POST['select_member']) {            
            $query = "SELECT SUM(per_head) FROM lunch_system WHERE members LIKE '%".$_POST['select_member']."%'";
      
        $result = mysqli_query($conn,$query);
        $balance = mysqli_fetch_array($result);            
    } else {
        $query = "";
    }
?>    
           
    <div class="payment-div">
        <form class="payment" action="" method="POST" >
            <fieldset>
                <legend><h3>Payment Screen</h3></legend>
                    <table>
                        <tr>
                            <td>Date:</td>
                            <td><input type="date" name="date" id="date"></td>
                            <td><span id="var_date" style="color:red;" class="error"><?php echo $dateErr?></span><td>
                        </tr>
                        <tr>
                            <td>Member:</td>
                            <td><select name="member" id="mSelect" style="width:145px;">
                    <option></option>
        <?php   $edit = "SELECT User FROM selected_members ";				
                        
                    $result = mysqli_query($conn,$edit);
                    while($row = mysqli_fetch_array($result)) {
        ?>
                    <option><?php echo $row["User"] ; } ?></option>  
        </select></td>
            <td><span id="var_mSelect" style="color:red;" class="error"><?php echo $mSelectErr?></span></td>        
                        </tr>
                        <tr>
                            <td>Amount paid:</td>
                            <td><input type="number" name="mpaid" id="mpaid"></td>
                            <td><span id="var_mpaid" style="color:red;" class="error"><?php echo $mpaidErr ; ?></span></td>
                        </tr>    
                        <tr>
                            <td></td>
                            <td><button onclick="return validate()">paid</button></td>
                        </tr>
                    </table>
            </fieldset>
        </form>
        </div>  
<span class="new_record">          
<?php
    if($_POST) {
                    
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "test";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 
             
                        $fetch = "INSERT INTO payment_table(date, member_name, payment, balance)
                                  VALUES ('".$_POST['date']."','".$_POST['member']."','".$balance['SUM(per_head)']."','".$_POST['mpaid']."') ";
            
             if ($conn->query($fetch) === TRUE) {
                        echo "New record created in system";
                    } else {
					echo "Error: " . $fetch . "<br>" . $conn->error;
				}       
            $conn->close();
    }
?>  
</span>                          
</body>
</html>