<?php
    $q = intval($_GET['q']);
    $conn = new mysqli("localhost", "root", "", "WestsideAutoIncDB");

    $customersql="SELECT * FROM Customer WHERE CustomerID = '".$q."'";
    $result = mysqli_query($conn, $customersql);    

    /* CUSTOMER INPUTS BASED ON THE SELECTION FROM THE CUSTOMER TABLE */

    while($row = mysqli_fetch_array($result)) {
        echo '';
        echo "<form class='data' action='customer.php' method='post'>
            <div class='grid-x grid-padding-x align-middle'>    
                <div class='large-12 cell'>
                    <hr>
                </div>
                
                <div class='large-12 cell'>
                    <h5>" . $row['FirstName'] . " " . $row['LastName'] . "<h5>
                </div>

                <div class='large-1 cell'>
                    <label for='firstName' class='text-right middle'>First Name</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='firstName' id='firstName' value=" . $row['FirstName'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='lastName' class='text-right middle'>Last Name</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='lastName' id='lastName' value=" . $row['LastName'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='gender' class='text-right middle'>Gender</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='gender' id='gender' value=" . $row['Gender'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='birthday' class='text-right middle'>Birthday</label>
                </div>
                <div class='large-5 cell'>
                    <input type='date' max='2999-12-31' name='birthday'value=" . $row['Birthday'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='taxID' class='text-right middle'>Tax ID</label>
                </div>
                <div class='large-5 cell'>
                    <input type='number' name='taxID' placeholder='11111111' value=" . $row['TaxID'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='phone' class='text-right middle'>Phone</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='phone' id='phone' value=" . $row['Phone'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='address' class='text-right middle'>Address</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='address' id='address' value=" . $row['Address'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='city' class='text-right middle'>City</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='city' id='city' value=" . $row['City'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='state' class='text-right middle'>State</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='state' id='state' value=" . $row['State'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='zip' class='text-right middle'>ZIP Code</label>
                </div>
                <div class='large-5 cell'>
                    <input type='text' name='zip' id='zip' value=" . $row['Zip'] . ">
                </div>

                <div class='large-1 cell'>
                    <label for='noLatePayments' class='text-right middle'>No. late payments</label>
                </div>
                <div class='large-5 cell'>
                    <input type='number' name='noLatePayments' disabled>
                </div>

                <div class='large-1 cell'>
                    <label for='avgNoDaysLate' class='text-right middle'>Avg no. days late</label>
                </div>
                <div class='large-5 cell'>
                    <input type='number' name='avgNoDaysLate' disabled>
                </div>
            </div>
            <!--<div class='grid-x grid-padding-x'>
                <div class='large-12 cell'>
                    <input type='submit' class='button float-right' id='finalize-customer' name='finalize-customer' value='Create'>
                </div>
            </div>-->
        </form>";
    }
    mysqli_close($conn);
?>

<!-- DIV FOR PAYMENT HISTORY BUTTON -->

<div class="grid-x grid-padding-x align-middle">
    <div class="large-6 cell">
        <h5>Payment history</h5>
    </div>
    <div class="large-6 cell"> 
        <?php 
            echo '<a href="customer/newpayment.php?q='.$q.'"><button class="button float-right">New payment</button></a>';
        ?>
    </div>
</div>

<!-- PAYMENT HISTORY TABLE -->

<div class="grid-x grid-padding-x align-middle">
    <div class="large-12 cell"> 
        <table id="paymentTable" class="display">
            <thead>
                <tr>
                    <th>Expected Date</th>
                    <th>Paid Date</th>
                    <th>Amount Due</th>
                    <th>Amount Paid</th>
                    <th>Bank Account</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $conn = new mysqli("localhost", "root", "", "WestsideAutoIncDB");
                    $sqlpayment = "SELECT * FROM Payment WHERE CustomerID = '".$q."' ORDER BY PaymentID DESC";
                    $result = mysqli_query($conn, $sqlpayment);
                    while ($row = $result->fetch_assoc()) {
                        $ExpectedDate = $row['ExpectedDate'];
                        $PaidDate = $row['PaidDate'];
                        $AmountDue = $row['AmountDue'];
                        $AmountPaid = $row['AmountPaid'];
                        $BankAccount = $row['BankAccount'];
                        echo '<tr>';
                        echo '<td>'.$ExpectedDate.'</td>';
                        echo '<td>'.$PaidDate.'</td>';
                        echo '<td>$'.$AmountDue.'</td>';
                        echo '<td>$'.$AmountPaid.'</td>';
                        echo '<td>'.$BankAccount.'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>		
    </div>
</div>

<!-- DIV FOR EMPLOYMENT HISTORY BUTTON -->

<div class="grid-x grid-padding-x align-middle">
    <div class="large-6 cell">
        <h5>Employment history</h5>
    </div>
    <div class="large-6 cell"> 
        <?php 
            echo '<a href="customer/newemploymenthistory.php?q='.$q.'"><button class="button float-right">New employment history</button></a>';
        ?>
    </div>
</div>

<!-- EMPLOYMENT HISTORY TABLE -->

<div class="grid-x grid-padding-x align-middle">
    <div class="large-12 cell float-bottom"> 
        <table id="employmentHistoryTable" class="display">
            <thead>
                <tr>
                    <th>Employer</th>
                    <th>Title</th>
                    <th>Supervisor</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Start Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $conn = new mysqli("localhost", "root", "", "WestsideAutoIncDB");
                    $sqlemployment = "SELECT * FROM EmploymentHistory WHERE CustomerID = '".$q."' ORDER BY EmploymentHistoryID DESC";
                    $result = mysqli_query($conn, $sqlemployment);
                    while ($row = $result->fetch_assoc()) {
                        $Employer = $row['Employer'];
                        $Title = $row['Title'];
                        $Supervisor = $row['Supervisor'];
                        $Phone = $row['Phone'];
                        $Address = $row['Address'];
                        $StartDate = $row['StartDate'];
                        echo '<tr>';
                        echo '<td>'.$Employer.'</td>';
                        echo '<td>'.$Title.'</td>';
                        echo '<td>'.$Supervisor.'</td>';
                        echo '<td>'.$Phone.'</td>';
                        echo '<td>'.$Address.'</td>';
                        echo '<td>'.$StartDate.'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>		
    </div>
</div>
