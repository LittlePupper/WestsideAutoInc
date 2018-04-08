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
		<title>Westside Auto Inc. | Customer</title>
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
                    <li><a href="sale.php">Sale</a></li>
                    <li class="active"><a href="customer.php">Customer</a></li>
                    <li><a href="buyer.php">Buyer</a></li>
                    <li><a href="salesperson.php">Salesperson</a></li>
                    <li><a href="warrantyitem.php">Warranty Item</a></li>
                </ul>
            </div>
        </div>
        
        <div class="form">
            <div class="grid-container">
                <div class="large-12 cell">
                    <div class="title">Payments made by a customer</div>
                    <div class="description">Use this form when editing customer payment information.</div>
                </div>
                
                <form>  
                    <div class="grid-x grid-padding-x align-middle">
                        <div class="large-12 cell"> 
                            
                            <table id="customerTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
								<tbody>
								    <?php 
                                        $sql = "SELECT CustomerID, FirstName, LastName FROM Customer";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = $result->fetch_assoc()) {
                                            $CustomerID = $row['CustomerID'];
                                            $FirstName = $row['FirstName'];
                                            $LastName = $row['LastName'];
                                            echo '<tr>';
                                            echo '<td>'.$CustomerID.'</td>';
                                            echo '<td>'.$FirstName.'</td>';
                                            echo '<td>'.$LastName.'</td>';
                                            echo '<td><button type="button" id="'.$CustomerID.'" class="button float-right table-button">Edit</button></td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>		
                            
                        </div>
                    </div>
                </form>
                
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
                            <strong>Yay!</strong> - You added a new customer!
                            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div></div>';
                            }

                        $stmt->close();
                    }
                ?>
                <form class="data" action="customer.php" method="post">
                    <div class="grid-x grid-padding-x align-middle">    
                        <div class="large-12 cell">
                            <hr>
                        </div>

                        <div class="large-1 cell">
                            <label for="firstName" class="text-right middle">First Name</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="firstName" id="firstName">
                        </div>

						<div class="large-1 cell">
                            <label for="lastName" class="text-right middle">Last Name</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="lastName" id="lastName">
                        </div>
						
                        <div class="large-1 cell">
                            <label for="gender" class="text-right middle">Gender</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="gender" id="gender">
                        </div>

                        <div class="large-1 cell">
                            <label for="birthday" class="text-right middle">Birthday</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="date" max="2999-12-31" name="birthday">
                        </div>

                        <div class="large-1 cell">
                            <label for="taxID" class="text-right middle">Tax ID</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="taxID" placeholder="11111111">
                        </div>

						<div class="large-1 cell">
                            <label for="phone" class="text-right middle">Phone</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="phone" id="phone">
                        </div>
						
						<div class="large-1 cell">
                            <label for="address" class="text-right middle">Address</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="address" id="address">
                        </div>
						
						<div class="large-1 cell">
                            <label for="city" class="text-right middle">City</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="city" id="city">
                        </div>
						
						<div class="large-1 cell">
                            <label for="state" class="text-right middle">State</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="state" id="state">
                        </div>
						
						<div class="large-1 cell">
                            <label for="zip" class="text-right middle">ZIP Code</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="zip" id="zip">
                        </div>
						
                        <div class="large-1 cell">
                            <label for="noLatePayments" class="text-right middle">No. late payments</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="noLatePayments" disabled>
                        </div>

                        <div class="large-1 cell">
                            <label for="avgNoDaysLate" class="text-right middle">Avg no. days late</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="avgNoDaysLate" disabled>
                        </div>
                    </div>
					<div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <input type="submit" class="button float-right" id="finalize-customer" name="finalize-customer" value="Create">
                        </div>
                    </div>
                </form>
                
                <!-- PAYMENT MODAL -->
                
                <div class="reveal" id="paymentModal" data-reveal>
                    <div class="description">New payment</div>
                    <form>
                        <div class="grid-x grid-padding-x align-middle">

                            <div class="large-2 cell align-middle">
                                <label for="paymentDate" class="text-right middle">Payment date</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="date" name="paymentDate">
                            </div>

                            <div class="large-2 cell">
                                <label for="paidDate" class="text-right middle">Paid date</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="date" name="paidDate">
                            </div>
                            
                            <div class="large-2 cell">
                                <label for="due" class="text-right middle">Due</label>
                            </div>
                            <div class="large-10 cell">
                                <div class="input-group">
                                    <span class="input-group-label">$</span>
                                    <input class="input-group-field" name="due" type="number" placeholder="3549.00">
                                </div>
                            </div>

                            <div class="large-2 cell">
                                <label for="amount" class="text-right middle">Amount</label>
                            </div>
                            <div class="large-10 cell">
                                <div class="input-group">
                                    <span class="input-group-label">$</span>
                                    <input class="input-group-field" name="amount" type="number" placeholder="3549.00">
                                </div>
                            </div>

                            <div class="large-2 cell">
                                <label for="bankAccount" class="text-right middle">Bank account</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="number" name="bankAccount">
                            </div>
                            
                             <div class="large-12 cell">
                                <input type="button" class="button float-right" id="add-vehicle" name="add-vehicle" value="Add payment" />
                            </div>
                        </div>
                    </form>
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="grid-x grid-padding-x align-middle">
                    <div class="large-12 cell"> 
                        <button class="button float-right" data-open="paymentModal">New payment</button>
                    </div>
                </div>
                
                <!--EMPLOYMENT HISTORY MODAL -->
                
                <div class="reveal" id="employmentHistoryModal" data-reveal>
                    <div class="description">New employment history</div>
                    <form>
                        <div class="grid-x grid-padding-x align-middle">

                            <div class="large-2 cell align-middle">
                                <label for="employer" class="text-right middle">Employer</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="text" name="employer">
                            </div>

                            <div class="large-2 cell">
                                <label for="title" class="text-right middle">Title</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="text" name="title">
                            </div>
                            
                            <div class="large-2 cell">
                                <label for="supervisor" class="text-right middle">Supervisor</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="text" name="supervisor">
                            </div>
                            
                            <div class="large-2 cell">
                                <label for="phone" class="text-right middle">Phone</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="tel" name="phone">
                            </div>
                            
                            <div class="large-2 cell">
                                <label for="address" class="text-right middle">Address</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="tel" name="address">
                            </div>

                            <div class="large-2 cell">
                                <label for="startDate" class="text-right middle">Start date</label>
                            </div>
                            <div class="large-10 cell">
                                <input type="date" name="startDate">
                            </div>
                            
                             <div class="large-12 cell">
                                <input type="button" class="button float-right" id="add-employment-history" name="add-employment-history" value="Add employment history" />
                            </div>
                        </div>
                    </form>
                    
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="grid-x grid-padding-x align-middle">
                    <div class="large-12 cell"> 
                        <button class="button float-right" data-open="employmentHistoryModal">New employment history</button>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- JQUERY FIRST -->
		
		<script type="text/javascript" src="js/vendor/jquery.js"></script>
		
		<!-- OTHER SCRIPTS -->
		
		<script type="text/javascript" src="js/vendor/foundation.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>	
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.foundation.min.js"></script>
        
        <!--START DATATABLES-->
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