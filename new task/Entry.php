<?php
include('session1.php');
?>

<!doctype html>
<html>
<head>    
    <title>Entry</title>    
    <link rel="stylesheet" href="styles.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://localhost/php/newtask/addbutton_jquery.js"></script>

<script type="text/javascript">
    function myFunction(value) { 
        var options = document.getElementById('mSelect').options, count = 0;
        for (var i = 0; i < options.length; i++) {
            if (options[i].selected)
                count++;
        }
        var resultText = value/count ;
        console.log("resultText :"+resultText);
        document.getElementById("resultHere").value=resultText;
    }
</script>

</head>        
    <body>         
    <script src="http://localhost/php/newtask/entry_validation.js"></script>
                
<div class="menu">
    <div class="header-bar-color">
        <div class="header-bar">
            <div class="history">    
                <div class="history-tab">
                    <a href="data.php" style="margin-left:5px;">History</a>
                </div>     
                <div class="member-tab"> 
                    <a href="member_data.php" style="margin-left:5px;">Member History</a> 
                </div>
                <div class="payment-detail-tab">
                    <a href="Payment_details.php" style="margin-left:5px;">Search By Date</a> 
                </div>
                <div class="payment-tab">
                    <a href="Payment.php" style="margin-left:5px;">Payment</a>
                </div>
                <input name="logout" type="button" id="logout" value="logout" onclick="window.location='logout1.php'" >
            </div>
        </div> 
    </div>             
<?php
$add = "";
$dateErr=$memberErr=$mytextErr=$paidErr=$amountErr="";
$date=$member=$mytext=$paid=$amount="";


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["date"])){
			$dateErr="date required";
		} else {
			$date = test_input($_POST["date"]);
		}
        
		if (empty($_POST["member"])){
			$memberErr="member required";
		} else {
			$member = test_input($_POST["member"]);
		}
        
        if (empty($_POST["mytext"])){
			$mytextErr="items required";
		} else {
			$mytext = test_input($_POST["mytext"]);
		}
        
        if (empty($_POST["paid"])){
			$paidErr="select member ";
		} else {
			$paid = test_input($_POST["paid"]);
		}
        
        if (empty($_POST["amount"])){
			$amountErr="amount required";
		} else {
			$amount = test_input($_POST["amount"]);
		}
	}
function test_input($data) {
	
}

?>            
    <form action="" method="POST" onSubmit="return revalidate()" >
        <fieldset class="field">

    <div class="main">
        
        Date:
        <div class="align">
            <input type="date" name="date" id="date">
            </div>
            <span id="var_date" style="color:red;"><?php echo $dateErr;?></span>
        <br>

        Members:
        <div class="align">
                    <select multiple="multiple" name="member[]" id="mSelect" size="3" style="width:150px;">
                            <?php
                        
                                $conn = mysqli_connect('localhost','root','','test');
                                mysqli_select_db($conn,"test");

                                $edit = "SELECT User FROM selected_members ";				
                                    
                                $result = mysqli_query($conn,$edit);
                                                                
                                while($row = mysqli_fetch_array($result)) {
                                ?>
                        <option value="<?php echo $row["User"] ;  ?>">
                            <?php echo $row["User"] ;  ?>
                        </option>
                        <?php } ?>
                    </select>
            </div>
            <span id="var_mSelect" style="color:red;"><?php echo $memberErr;?></span>
        <br>

        Items:  
            <div class="align">
                <div class="input_fields_wrap">   
                    <div>
                        <div>
                            <input type="text" name="mytext[]" id="mytext">
                            <button class="add_field_button">Add More</button>
                        </div>  
                    </div> 
                </div>
            </div>
        <span id="var_mytext" style="color:red;"><?php echo $mytextErr;?></span>
        <br>

        Paid money:
        <div class="align">
            <select name="paid" id="paid" style="width:150px;">
                <option></option>
                <?php
                        $conn = mysqli_connect('localhost','root','','test');
                        mysqli_select_db($conn,"test");

                        $edit = "SELECT User FROM selected_members ";				
                                
                        $result = mysqli_query($conn,$edit);
                        while($row = mysqli_fetch_array($result)) {
                    ?>
                    <option><?php echo $row["User"] ; } ?></option>  
                </select>
            </div>
        <span id="var_paid" style="color:red;"><?php echo $paidErr;?></span>
        <br>

        Total amount:
        <div class="align">
            <input type="number" name="amount" id="amount" class="countOne" onkeyup="myFunction(this.value)">
            </div>
        <span id="var_amount" style="color:red;"><?php echo $amountErr;?></span>                                
        <br>

        Perhead: 
            <div class="align">
                <input type="text" name="per_head" id="resultHere" readonly>
            </div>
                                    
                <br><br>
                <input type="submit" value="submit">    
                </div>
            </fieldset>
                
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
                        
                
                $items=implode(',',$_POST['mytext']);
                $select=implode(',',$_POST['member']);
                
                foreach ($_POST['member'] as $key => $value) {
                    $query = "SELECT Balance FROM selected_members WHERE User LIKE '%".$value."%' ";
                    
                    $result = mysqli_query($conn,$query);    
                    $balance = mysqli_fetch_array($result);
                                 
                    if(!empty($balance['Balance'])){
                        
                            $add = $balance['Balance'] + $_POST['per_head'] ;
                            $new = "UPDATE selected_members SET Balance = '".$add."'
                                    WHERE User = '".$value."' ";                               
                    } 
                }                                    
                    $new = "INSERT INTO Lunch_system (date, members, items, paid, amount, per_head)
                            VALUES ('".$_POST['date']."', '".$select."', '".$items."', '".$_POST['paid']."', '".$_POST['amount']."', '".$_POST['per_head']."' )";
                    
                    if ($conn->query($new) === TRUE) {
                        echo "New record created in system";
                    } else {
					echo "Error: " . $new . "<br>" . $conn->error;
				    }
                                    
            $conn->close();
            }
    ?>
        </form>
	 </div>
</body>
</html>                               