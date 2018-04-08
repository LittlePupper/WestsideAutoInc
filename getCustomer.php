<?php
    $q = intval($_GET['q']);
    $conn = new mysqli("localhost", "root", "", "WestsideAutoIncDB");

    mysqli_select_db($conn,"ajax_demo");
    $customersql="SELECT * FROM Customer WHERE CustomerID = '".$q."'";
    $result = mysqli_query($conn, $customersql);    

    while($row = mysqli_fetch_array($result)) {
        echo "<form class='data' action='customer.php' method='post'>
            <div class='grid-x grid-padding-x align-middle'>    
                <div class='large-12 cell'>
                    <hr>
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
            <div class='grid-x grid-padding-x'>
                <div class='large-12 cell'>
                    <input type='submit' class='button float-right' id='finalize-customer' name='finalize-customer' value='Create'>
                </div>
            </div>
        </form>";
    }
    mysqli_close($conn);
?>

<!-- PAYMENT MODAL -->

<div class="grid-x grid-padding-x align-middle">
    <div class="large-6 cell">
        <h5>Payment history</h5>
    </div>
    <div class="large-6 cell"> 
        <button class="button float-right" data-open="paymentModal">New payment</button>
    </div>
</div>

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

<div class="grid-x grid-padding-x align-middle">
    <div class="large-6 cell">
        <h5>Employment history</h5>
    </div>
    <div class="large-6 cell"> 
        <button class="button float-right" data-open="employmentHistoryModal">New employment history</button>
    </div>
</div>

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