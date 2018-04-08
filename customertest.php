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
        
        <script>
            function showUser(str) {
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else { 
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","getCustomer.php?q="+str,true);
                    xmlhttp.send();
                }
            }
        </script>

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
                
                <!--PHP FOR INSERTING A CUSTOMER INTO THE DB-->
                
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
                
                <!--CUSTOMER TABLE-->
                
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
                                        echo '<td><button type="button" id="'.$CustomerID.'" class="float-right table-button" onclick="showUser(this.id)">Edit</button></td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>		
                    </div>
                </div>
                
                <div id="txtHint">Customer data will be displayed here...</div>

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