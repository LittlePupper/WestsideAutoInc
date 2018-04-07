<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title>Westside Auto Inc. | Customer</title>
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />

		<!-- CSS -->
		
		<link rel="stylesheet" href="css/app.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="css/foundation.min.css" rel="stylesheet" type="text/css" />
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
                        <div class="large-1 cell">
                            <label for="middle-label" class="text-right middle">Customer search</label>
                        </div>
                        <div class="large-5 cell">
                            <div class="input-group">
                                <input class="input-group-field" type="text" placeholder="John Doe">
                                <div class="input-group-button">
                                    <input type="submit" class="button" value="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form>
                    <div class="grid-x grid-padding-x align-middle">    
                        <div class="large-12 cell">
                            <hr>
                        </div>

                        <div class="large-1 cell">
                            <label for="name" class="text-right middle">Name</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="text" name="name" id="name">
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
                            <input type="date" name="birthday">
                        </div>

                        <div class="large-1 cell">
                            <label for="taxID" class="text-right middle">Tax ID</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="number" name="taxID" placeholder="11111111">
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
                </form>
                
                <form>
                    <div class="grid-x grid-padding-x align-middle">
                        <div class="large-12 cell">
                            <hr>
                        </div>

                        <div class="large-12 cell">
                            <h5 class="float-left">New payment</h5>
                            <input type="button" class="button float-right" id="add-vehicle" name="add-vehicle" value="Add payment" />
                        </div>

                        <div class="large-1 cell align-middle">
                            <label for="paymentDate" class="text-right middle">Payment date</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="date" name="paymentDate">
                        </div>

                        <div class="large-1 cell">
                            <label for="due" class="text-right middle">Due</label>
                        </div>
                        <div class="large-5 cell">
                            <div class="input-group">
                                <span class="input-group-label">$</span>
                                <input class="input-group-field" name="due" type="number" placeholder="3549.00">
                            </div>
                        </div>

                        <div class="large-1 cell">
                            <label for="paidDate" class="text-right middle">Paid date</label>
                        </div>
                        <div class="large-5 cell">
                            <input type="date" name="paidDate">
                        </div>

                        <div class="large-1 cell">
                            <label for="amount" class="text-right middle">Amount</label>
                        </div>
                        <div class="large-5 cell">
                            <div class="input-group">
                                <span class="input-group-label">$</span>
                                <input class="input-group-field" name="amount" type="number" placeholder="3549.00">
                            </div>
                        </div>

                        <div class="large-1 cell">
                            <label for="bankAccount" class="text-right middle">Bank account</label>
                        </div>
                        <div class="large-11 cell">
                            <input type="number" name="bankAccount">
                        </div>
                    </div>
                </form>
                    
                <table>
                    <thead>
                        <th>Date</th>
                        <th>Due</th>
                        <th>Paid date</th>
                        <th>Amount</th>
                        <th>Bank account</th>
                    </thead>
                    <tbody>
                        <?php foreach($execute->$result as $payment) : ?>
                        <tr>
                            <td><?php echo $payment->Date ?></td>
                            <td><?php echo $payment->Due ?></td>
                            <td><?php echo $payment->PaidDate ?></td>
                            <td><?php echo $payment->Amount ?></td>
                            <td><?php echo $payment->BankAccount ?></td>
                        </tr>
                        <?php endforeach; ?>
        <!--
                        <?php
                            while ($row = mysql_fetch_array($query)) {
                                echo "<tr>";
                                echo "<td>".$row[Date]."</td>";
                                echo "<td>".$row[Due]."</td>";
                                echo "<td>".$row[PaidDate]."</td>";
                                echo "<td>".$row[Amount]."</td>";
                                echo "<td>".$row[BankAccount]."</td>";
                                echo "</tr>";
                            }
                        ?>
        -->
                    </tbody>
                </table>
                
            </div>
        </div>
        
        <!-- JQUERY FIRST -->
		
		<script type="text/javascript" src="js/vendor/jquery.js"></script>
        <script type="text/javascript" >
            jQuery(function($){
                var $button = $('#another-problem'),
                    $row = $('.problem-group').clone();

                $button.click(function(){
                    $row.clone().insertBefore( $button );
                });
            });
        </script>
		
		<!-- OTHER SCRIPTS -->
		
		<script type="text/javascript" src="js/vendor/foundation.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>		
	</body>
</html>