<?php
//    $servername = "localhost";
//    $username = "root";
//    $password = "";
//    $dbname = "WestsideAutoIncDB";

    $sql = "INSERT INTO Buyer (FirstName, LastName, Phone)
                   VALUES ('firstName', 'lastName', 'phone')";
    $conn->query($sql)

    // Create connection
    function connect_sql() {
//        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn = new mysqli("localhost", "root", "", "WestsideAutoIncDB");
        
        // Check connection
        if ($conn->error) {
            die("Error: " . $conn->error);
        }
        return $conn;
    }

    function insert_buyer() {
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
 ?>

<?php 
    $conn = connect_sql();
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title>Westside Auto Inc. | Buyer</title>
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />

		<!-- CSS -->
		
		<link rel="stylesheet" href="css/app.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="css/foundation.min.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
        
        <?php
            if(isset($_POST['save'])){
                $sql = "INSERT INTO Buyer (FirstName, LastName, Phone)
                    VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["email"]."')";
                }
        ?>
        
        <!-- NAVIGATION -->
        
        <div class="grid-x">
            <div class="cell">
                <ul class="menu align-right menu-hover-lines">
                    <li><a href="/">Home</a></li>
                    <li><a href="purchase.html">Purchase</a></li>
                    <li><a href="sale.html">Sale</a></li>
                    <li><a href="payment.html">Payment</a></li>
                    <li class="active"><a href="#">Buyer</a></li>
                </ul>
            </div>
        </div>
        
        <div class="form">
            <div class="grid-container">
                <div class="large-12 cell">
                    <div class="title">Add a new buyer</div>
                    <div class="description">Use this form to create a new buyer employee.</div>
                </div>
                <form action="buyer.php" method="post">
                    
                    <div class="grid-x grid-padding-x ">    

                        <div class="large-1 cell">
                            <label for="firstName" class="text-right middle">First name</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="firstName" id="firstName" placeholder="John">
                        </div>

                        <div class="large-1 cell">
                            <label for="lastName" class="text-right middle">Last name</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="lastName" id="lastName" placeholder="Doe">
                        </div>

                        <div class="large-1 cell">
                            <label for="phone" class="text-right middle">Phone</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="tel" name="phone" placeholder="14031234567">
                        </div>

                    </div>
                        
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <input type="submit" class="button float-right" id="addBuyer" name="addBuyer" value="Create buyer">
                        </div>
                    </div>
                    
                </form>
                
                <!-- SUCCESS ALERT -->
                
                <div data-closable class="callout alert-callout-border success">
                    <strong>Yay!</strong> - You added a new buyer!
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <!-- WARNING ERROR -->
                
                <div data-closable class="callout alert-callout-border alert">
                    <strong>Boo!</strong> - That didn't work!
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
            </div>
            
        </div>
        
        <!-- JQUERY FIRST -->
		
		<script type="text/javascript" src="js/vendor/jquery.js"></script>
		
		<!-- OTHER SCRIPTS -->
		
		<script type="text/javascript" src="js/vendor/foundation.min.js"></script>
        <script src="js/foundation/foundation.alert.js"></script>
		<script type="text/javascript" src="js/app.js"></script>		
	</body>
</html>

<?php 
    $conn->close();
?>