<!DOCTYPE html>
<?php
    // Create connection
    function connect_sql() {
        $conn = new mysqli("localhost", "root", "", "WestsideAutoIncDB");
        
        // Check connection
        if ($conn->error) {
            die("Error: " . $conn->error);
        }
        return $conn;
    }
?>

<?php 
    $conn = connect_sql();
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title>Westside Auto Inc. | Sale</title>
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />

		<!-- CSS -->
		
		<link rel="stylesheet" href="css/app.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="css/foundation.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.foundation.min.css">
	</head>
	
	<body>
        
        <!-- NAVIGATION -->
        
        <div class="grid-x">
            <div class="cell">
                <ul class="menu align-right menu-hover-lines">
                    <li><a href="/">Home</a></li>
                    <li><a href="purchase.php">Purchase</a></li>
                    <li class="active"><a href="sale.php">Sale</a></li>
                    <li><a href="customer.php">Customer</a></li>
                    <li><a href="buyer.php">Buyer</a></li>
                    <li><a href="salesperson.php">Salesperson</a></li>
                    <li><a href="warrantyitem.php">Warranty Item</a></li>
                </ul>
            </div>
        </div>
        
        <div class="form">
            <div class="grid-container">
                <div class="large-12 cell">
                    <div class="title">Sell a vehicle</div>
                    <div class="description">Use this form when selling a vehicle to a customer.</div>
                </div>
				 <fieldset>
                    <div class="grid-x grid-padding-x ">
                        <div class="large-1 cell">
                            <label for="middle-label" class="text-right middle">Salesperson</label>
                        </div>
                        <div class="large-5 cell">
                            <?php 
                                $sql = "SELECT SalespersonID, FirstName, LastName FROM Salesperson ORDER BY LastName";
                                $result = mysqli_query($conn, $sql);

                                echo "<select name='buyerID'>";
                                while ($row = $result->fetch_assoc()) {
                                    $SalespersonID = $row['SalespersonID'];
                                    $FirstName = $row['FirstName'];
                                    $LastName = $row['LastName'];
                                    echo '<option value="'.$SalespersonID.'">' .$LastName.', ' .$FirstName. '</option>';
                                }
                                echo "</select>";
                            ?>
                        </div>
                    </div>
                        </fieldset>	
				  <?php
                    if(isset($_POST['finalize-customer'])){
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
						$gender = $_POST['gender'];
						$birthday = $_POST['birthday'];
						$taxID = $_POST['taxID'];
                        $phone = $_POST['phone'];
						$address = $_POST['address'];
						$city = $_POST['city'];
						$state = $_POST['state'];
						$zip = $_POST['zip'];

                        $stmt = $conn->prepare("INSERT INTO Customer (FirstName, LastName, Gender, Birthday, TaxID, Phone, Address, City, State, Zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssiissss", $firstName, $lastName, $gender, $birthday, $taxID, $phone, $address, $city, $state, $zip);

                        $stmt->execute();
                        if($stmt->affected_rows === -1) {
                            echo '<div class="large-12 cell "><div data-closable class="callout alert-callout-border alert">
                            <strong>Boo!</strong> - It broke!
                            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div></div>';
                        } else {
                            echo '<div class="large-12 cell "><div data-closable class="callout alert-callout-border success">
                            <strong>Yay!</strong> - You sold a new vehicle!
                            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div></div>';
                            }

                        $stmt->close();
                    }
                ?>
                
                <!--CUSTOMER INFORMATION-->
                
                <form class="data" action="sale.php" method="post">
                    <div class="grid-x grid-padding-x align-middle">    
                        <div class="large-12 cell">
                            <hr>
                        </div>

                        <div class='large-1 cell'>
                            <label for='firstName' class='text-right middle'>First name</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='firstName' 
                                   id='firstName' 
                                   placeholder='John'
                                   maxlength='50'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='lastName' class='text-right middle'>Last name</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='lastName' 
                                   id='lastName' 
                                   placeholder='Doe'
                                   maxlength='50'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='gender' class='text-right middle'>Gender</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='gender' 
                                   id='gender' 
                                   placeholder='Male'
                                   maxlength='20'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='birthday' class='text-right middle'>Birthday</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='date' 
                                   max='2999-12-31' 
                                   name='birthday' 
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='taxID' class='text-right middle'>Tax ID</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='number' 
                                   name='taxID'
                                   placeholder='1234567890' 
                                   oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'
                                   maxlength='10'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='phone' class='text-right middle'>Phone</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='phone' 
                                   id='phone' 
                                   placeholder='14031234567'
                                   oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'
                                   maxlength='11'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='address' class='text-right middle'>Address</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='address' 
                                   id='address' 
                                   placeholder='123 Center Street SE'
                                   maxlength='50'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='city' class='text-right middle'>City</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='city' 
                                   id='city' 
                                   placeholder='Calgary'
                                   maxlength='20'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='state' class='text-right middle'>State</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='state' 
                                   id='state' 
                                   placeholder='Alberta'
                                   maxlength='20'
                                   required>
                        </div>

                        <div class='large-1 cell'>
                            <label for='zip' class='text-right middle'>ZIP code</label>
                        </div>
                        <div class='large-5 cell'>
                            <input type='text' 
                                   name='zip' 
                                   id='zip' 
                                   maxlength='6'
                                   placeholder='T1K4G3'
                                   required>
                        </div>
                        <div class="large-12 cell">
                            <hr>
                        </div>
                    </div>
                    
                    <!--TABLE OF VEHICLES-->
                    
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <table id="customerTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Make</th>
                                        <th>Mode</th>
                                        <th>Year</th>
                                        <th>Color</th>
                                        <th>Mileage</th>
                                        <th>Style</th>
                                        <th>Interior Color</th>
                                        <th>Listing Price</th>
                                        <th>Selected</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT VehicleID, Make, Model, Year, Color, Mileage, Style, InteriorColor, ListingPrice FROM Vehicle";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = $result->fetch_assoc()) {
                                            $Make = $row['Make'];
                                            $Model= $row['Model'];
                                            $Year = $row['Year'];
                                            $Color = $row['Color'];
                                            $Mileage = $row['Mileage'];
                                            $Style = $row['Style'];
                                            $InteriorColor = $row['InteriorColor'];
                                            $ListingPrice = $row['ListingPrice'];
                                            echo '<tr>';
                                            echo '<td>'.$Year.'</td>';
                                            echo '<td>'.$Make.'</td>';
                                            echo '<td>'.$Model.'</td>';
                                            echo '<td>'.$Color.'</td>';
                                            echo '<td>'.$Mileage.'</td>';
                                            echo '<td>'.$Style.'</td>';
                                            echo '<td>'.$InteriorColor.'</td>';
                                            echo '<td>'.$ListingPrice.'</td>';	
                                            echo '<td><input type="radio" id="'.$ListingPrice.'" name="vehicleChoice"></td>';	
                                            echo '</tr>';

                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!--WARRANTY-->
                    
                    <div class="grid-x grid-padding-x align-middle"> 
                        <div class="large-1 cell">
                            <label for="WarrantyItem" class="text-right middle">Warranty type</label>
                        </div>
                        <div class="large-5 cell">
                            <?php 
                                $sql = "SELECT WarrantyItemID, Type FROM WarrantyItem ORDER BY Type";
                                $result = mysqli_query($conn, $sql);

                                echo "<select name='WarrantyItem'>";
                                while ($row = $result->fetch_assoc()) {
                                    $WarrantyItemID = $row['WarrantyItemID'];
                                    $Type = $row['Type'];
                                    echo '<option value="'.$WarrantyItemID.'">' .$Type.'</option>';
                                }
                                echo "</select>";
                            ?>			
                        </div>
                        <div class="large-1 cell">
                            <label for="year" class="text-right middle">Cost</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="Cost" placeholder="$0000">
                        </div>

                        <div class="large-1 cell">
                            <label for="make" class="text-right middle">Start Date</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="date" max="2999-12-31" name="StartDate">
                        </div>

                        <div class="large-1 cell">
                            <label for="model" class="text-right middle">End Date</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="date" max="2999-12-31" name="EndDate">
                        </div>

                        <div class="large-1 cell">
                            <label for="style" class="text-right middle">Deductable</label>
                        </div>

                        <div class="large-5 cell">
                            <input type="number" name="Deductable" placeholder="$0000">
                        </div>
                        
                        <div class="large-12 cell">
                            <input type="button" class="button float-right" id="add-problem" name="add-vehicle" value="Add another warranty" />
                        </div>
                    </div>  
                    

                    <div class="finalizeTemplate grid-x grid-padding-x"> 
                        <div class="large-12 cell">
                            <hr>
                        </div>                
                        <div class="large-7 cell">
                            <label for="Commission" class="text-right middle">Commission:</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="Commission" placeholder="$1000.00"><br>
                        </div>
                        
                        <div class="large-7 cell">
                            <label for="DownPayment" class="text-right middle">Down Payment:</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="DownPayment" placeholder="$0000"><br>
                        </div>

                        <div class="large-7 cell">
                            <label for="TotalDue" class="text-right middle">Finance Amount:</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="Finance Amount" placeholder="$0000"><br>
                        </div>

                        <div class="large-7 cell">
                            <label for="TotalDue" class="text-right middle">Total Due:</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="TotalDue" placeholder="$0000" disabled><br>
                        </div>
                        
                        <div class="large 12 cell">
                            <input type="submit" class="button float-right" id="submitSale" name="submitSale" value="Submit sale">
                        </div>
                    </div><!--/finalizeTemplate-->
                </form>
            
            </div><!--/grid-container-->
        </div><!--/form-->
    
        <!-- JQUERY FIRST -->
		
		<script type="text/javascript" src="js/vendor/jquery.js"></script>
        <script type="text/javascript" >
            jQuery(function($){
                var $buttonProblem = $('#add-problem'),
                    $rowProblem = $('.problem-group').clone(),
                    $buttonVehicle = $('#add-vehicle'),
                    $rowVehicle = $('.vehicle-group');

                $buttonProblem.click(function(){
                    $rowProblem.clone().insertBefore( $buttonProblem );
                });
                $buttonVehicle.click(function() {
                   $rowVehicle.clone().insertBefore( $buttonVehicle); 
                });
            });
        </script>
		
		<!-- OTHER SCRIPTS -->
		
		<script type="text/javascript" src="js/vendor/foundation.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>		
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.foundation.min.js"></script>
        
		<script type="text/javascript"> 
            $(document).ready( function () {
                $('#customerTable').DataTable();
            });
		</script>
    
	</body>
</html>

<?php 
    $conn->close();
?>