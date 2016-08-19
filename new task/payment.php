
<?php
include('session1.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="payment.css">
    </head>
<body>
    <div class="header-bar">
        <div class="header-option">
            <a href="Entry.php">Home</a>
        </div>	
    </div>

<?php 
$data['date']=$data['members']=$data['items']=$data['paid']=$data['amount']=$data['per_head']="";

	$conn = mysqli_connect('localhost','root','','test');
			mysqli_select_db($conn,"test");

				$query = "SELECT SUM(per_head) FROM lunch_system WHERE members LIKE '%".$_SESSION['login_user']."%'";
                $mamount = "SELECT balance FROM payment_table WHERE member_name LIKE '%".$_SESSION['login_user']."%' ORDER BY balance DESC";
                	
				$result = mysqli_query($conn,$query);
                $samount = mysqli_query($conn,$mamount);
                $balance = mysqli_fetch_array($result);
                $bamount = mysqli_fetch_array($samount);  
?>
    <div class="member-detail">
        <form class="selected-member" method="POST" action="">
            <fieldset>
                <legend><h3>Member Detail</h3></legend>
                <table>
                    <tr>
                        <!-- Name of member paying money-->
                        <td>Member:</td>
                        <td><select name="member" id="mSelect" style="width:145px;">
                                <option></option>
                    <?php
                                $conn = mysqli_connect('localhost','root','','test');
                                mysqli_select_db($conn,"test");

                                $edit = "SELECT User FROM selected_members ";				
                                    
                                $result = mysqli_query($conn,$edit);
                                while($row = mysqli_fetch_array($result)) {
                    ?>
                                <option><?php echo $row["User"] ; } ?></option>  
                    </select></td>
                        <td><span id="var_mSelect" style="color:red;"></span></td>
                        <td><input type="submit" value="submit"></td>
                    </tr>  
                </table>      
            </fieldset>
            </form>
        </div>   
        <script src="http://localhost/php/newtask/payment_validation.js"></script>


<div class="payment-div"> 
        <div>       
    <form class="payment" method="POST" action="" onSubmit="return validate()" >  
        <fieldset>
            <legend><h3>payment screen</h3></legend> 
    <table>
        <tr>
            <!-- Total amount of login member -->
            <td>Total Amount : </td>
            <td style="text-align:center;"><b><?php echo $balance['SUM(per_head)']; ?></b></td>
        </tr>
        <tr>
            <!-- balance amount of login member -->
            <td>Balance Amount : </td>
            <td style="text-align:center;"><b><?php echo $bamount['balance']; ?></b></td>
        </tr>           
        <tr>
            <!-- Date of new payment-->
            <td>Date:</td>
            <td><input type="date" name="date" id="date"></td>
            <td><span id="var_date" style="color:red;"></span></td>
        </tr>    
        <tr>
            <!-- Name of member paying money-->
            <td>Member:</td>
            <td><select name="member" id="mSelect" style="width:145px;">
                    <option></option>
        <?php
                    $conn = mysqli_connect('localhost','root','','test');
                    mysqli_select_db($conn,"test");

                    $edit = "SELECT User FROM selected_members ";				
                        
                    $result = mysqli_query($conn,$edit);
                    while($row = mysqli_fetch_array($result)) {
        ?>
                    <option><?php echo $row["User"] ; } ?></option>  
        </select></td>
            <td><span id="var_mSelect" style="color:red;"></span></td>
        </tr>    
        <tr>
            <!-- deduct paid amount -->
            <td>Amount Paid:</td>
            <td><input type="number" name="mpaid" id="mpaid" style="width:140px;"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="submit"></td>
        </tr>
    </table>        
    </fieldset>
    </form>  
    </div>  
</div>
<?php
    if($_POST){
                    
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
                        
                       $sub=$balance['SUM(per_head)'] - $_POST['mpaid'] ;
                                
            $fetch="INSERT INTO payment_table(date, member_name, payment, total_amount, balance)
                    VALUES ('".$_POST['date']."','".$_POST['member']."','".$_POST['mpaid']."','".$balance['SUM(per_head)']."','".$sub."')";
            $mdata="INSERT INTO selected_members(Balance)
                    VALUES ('".$sub."')
                    WHERE User LIKE '".$_POST['member']."' ";        
           
                if ($conn->query($mdata) === TRUE) {
                        echo "New record created in members data";
                    } else {
					echo "Error: " . $mdata . "<br>" . $conn->error;
				}
               
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