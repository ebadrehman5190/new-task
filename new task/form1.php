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

$balance['SUM(per_head)']="";
$data['per_head']="";
$_POST['select_member']="";
// define variables and set to empty values
$select_memberErr = "";
$select_member = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    <div class="member-detail">
        <form class="selected-member" method="POST" action="">
            <fieldset style="height:80px;">
                <legend><h3>Member Detail</h3></legend>
                <table>
                    <tr>
                        <!-- Name of member paying money-->
                        <td>Member:</td>
                        <td><select name="select_member" id="select_member" style="width:155px;">
                                <option></option>
                             <?php
                                $edit = "SELECT User FROM selected_members ";				
                                    
                                $result = mysqli_query($conn,$edit);
                                while($row = mysqli_fetch_array($result)) {
                             ?>
                                <option><?php echo $row["User"] ; } ?></option>  
                             </select></td>
                        <td style="width:50px;"></td>
                        <td>Amount:</td>
                        <td style="text-align:center;"><b>
                            <span><?php echo $balance['SUM(per_head)']; ?></span></b><td>
                        <td style="width:50px;"></td>     
                        <td><input type="submit" value="submit"></td>
                    </tr>    
                    <tr>
                        <td></td>
                        <td><span class="error"><?php echo $select_memberErr ; ?></span><td>
                    </tr>  
                </table>      
            </fieldset>
            </form>
        </div>  
</body>
</html>         
