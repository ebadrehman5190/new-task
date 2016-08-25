<?php
include('session1.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search By Date</title>
    <link rel="stylesheet" href="search_by_date.css">
</head>
<body>
    <div class="header-bar">
        <div class="header-option">
            <a href="Entry.php">Home</a>
        </div>
        <div class="logout">
				<input name="logout" type="button" id="logout" value="logout" onclick="window.location='logout1.php'" >
		</div>	
    </div>
        <script src="http://localhost/php/newtask/payment_validation.js"></script>

<?php 
$data['date']=$data['members']=$data['items']=$data['paid']=$data['amount']=$data['per_head']=""; 
?>
        
<div class="bg_color">
<form class="payment" method="POST" action="" onSubmit="return validate()">  
    <fieldset>
         <legend><h3>payment screen</h3></legend> 

<table>
    <tr>
        <td>Date:</td>
        <td><input type="date" name="date" id="date"></td>
        <td><span id="var_date" style="color:red;"></span></td>
    </tr>    
    <tr>
        <td>Member:</td>
        <td><select name="member" id="mSelect">
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
        <td></td>
        <td><input type="submit" value="search"></td>
    </tr>
</table>    
</fieldset>
</form>    

<?php
    if($_POST){
                    
    $conn = mysqli_connect('localhost','root','','test');
    mysqli_select_db($conn,"test");
				
    $fetch="SELECT date, members, items, paid, amount, per_head FROM lunch_system WHERE date ='". $_POST['date'] ."' AND members LIKE '%". $_POST['member'] ."%' ";
                
    $amount = mysqli_query($conn, $fetch);
    $data = mysqli_fetch_array($amount);
    }
?>

<br>
<table class="show_data">
    <tr>
        <td>Date:</td>
        <td><span><b><?php echo $data['date']; ?></b></span>
    </tr>    
    <tr>
        <td>Members:</td>
        <td><span><b><?php echo $data['members']; ?></b></span></td>
    </tr>    
    <tr>
        <td>Items:</td>
        <td><span><b><?php echo $data['items']; ?></b></span></td>
    </tr>
    <tr>
        <td>Paid:</td>
        <td><span><b><?php echo $data['paid']; ?></b></span></td>
    </tr>
    <tr>
        <td>Amount:</td>
        <td><span><b><?php echo $data['amount']; ?></b></span></td>
    </tr>
    <tr>
        <td>Per_head:</td>
        <td><span><b><?php echo $data['per_head']; ?></b></span></td>
    </tr>    
</table>
</div>
</body>
</html>