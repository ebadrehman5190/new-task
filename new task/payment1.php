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


if ($_SERVER["REQUEST_METHOD"] == "POST['fetch_amount']") {
  if (empty($_POST['select_member'])) {
      $select_memberErr = "please select a member";
  } else {
      $select_member = test_input($_POST["select_member"]);
  }
}
//fetch query
    $conn = mysqli_connect('localhost','root','','test');
            mysqli_select_db($conn,"test");
    if(!empty($_POST['select_member'])){
            $query = "SELECT SUM(per_head) FROM lunch_system WHERE members LIKE '%".$_POST['select_member']."%'";
    
        $result = mysqli_query($conn,$query);
        $balance = mysqli_fetch_array($result);                 
    } else{
        $balance['SUM(per_head)'] = "";
    }
?>    

    <div class="member-detail">
        <form class="selected-member" method="POST" action="">
            <fieldset style="height:80px;">
                <legend><h3>Member Detail</h3></legend>
                <table>
                    <tr>
<!-- Name of member to find amount-->
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
<!--Fetch total amount of selected member-->
                        <td>Amount:</td>
                        <td style="text-align:center;"><b>
                            <span><?php echo $balance['SUM(per_head)']; ?></span></b><td>
                        <td style="width:50px;"></td>     
<!--button of fetch amount-->
                        <td><button type="submit" name="fetch_amount" value="amount">Amount</button></td>
                    </tr>    
                    <tr>
                        <td></td>
                        <td><td>
                    </tr>  
                </table>      
            </fieldset>
            </form>
        </div>  
<!--  Submit data form starts -->         
    <div class="payment-div">
        <form class="payment" action="" method="POST" >
            <fieldset>
                <legend><h3>Payment Screen</h3></legend>
                    <table>
                        <tr>
<!--insert date of payment-->
                            <td>Date:</td>
                            <td><input type="date" name="date" id="date"></td>
                            <td></td>
                        </tr>
                        <tr>
<!--insert member name of payment-->
                            <td>Member:</td>
                            <td><select name="member" id="member" style="width:145px;">
                    <option></option>
        <?php   $edit = "SELECT User FROM selected_members ";				
                        
                    $result = mysqli_query($conn,$edit);
                    while($row = mysqli_fetch_array($result)) {
        ?>
                    <option><?php echo $row["User"] ; } ?></option>  
        </select></td>
            <td></td>        
                        </tr>
                        <tr>
<!--insert amount -->
                            <td>Amount paid:</td>
                            <td><input type="number" name="mpaid" id="mpaid"></td>
                            <td></td>
                        </tr>    
                        <tr>
                            <td></td>
<!--submit button of insert data-->
                            <td><input type="submit" name="submit_data" value="paid" onclick="return validate()" style="width:80px;"></td>
                        </tr>
                    </table>
            </fieldset>
        </form>
        </div>  

<?php
    if(isset($_POST['submit_data'])) {
                    
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
                                     
                    $query = "SELECT SUM(per_head) FROM lunch_system WHERE members LIKE '%".$_POST['member']."%'";
    
                    $result = mysqli_query($conn,$query);
                    $balance = mysqli_fetch_array($result);
                        
                    $sub = $balance['SUM(per_head)'] - $_POST['mpaid'] ;
                     
                    $fetch = "INSERT INTO payment_table(date, member_name, payment, paid, balance)
                              VALUES ('".$_POST['date']."','".$_POST['member']."','".$balance['SUM(per_head)']."','".$_POST['mpaid']."','".$sub."')"; 
                    $fetch = "UPDATE selected_members SET Balance = '".$sub."'
                              WHERE User = '".$_POST['member']."' ";
                        
             if ($conn->query($fetch) === TRUE) {    
                    echo "New record created in system";  
             } else {
		        echo "Error: " . $fetch . "<br>" . $conn->error;
		     }       
        $conn->close();
    }
?>  
     
</body>
</html>