<?php include 'header.php';?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $medicine_id = $_POST["medicine_id"];
    $quantity = $_POST["quantity"];
    $customer_name = $_POST["customer_name"];

    // Retrieve medicine price
    $price_query = "SELECT price FROM medicines WHERE id = '$medicine_id'";
    $price_result = $conn->query($price_query);

    if ($price_result->num_rows > 0) {
        $row = $price_result->fetch_assoc();
        $price = $row["price"];
        $total_price = $quantity * $price;

        // Insert sale record into the sales table
        $sell_sql = "INSERT INTO sales (medicine_id, quantity, total_price, customer_name) VALUES ('$medicine_id', '$quantity', '$total_price', '$customer_name')";

        if ($conn->query($sell_sql) === TRUE) {
            $success = "Sale successfully";
        } else {
            $error = "Error: " . $sell_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Medicine not found";
    }
}

?>

<div class="container mt-5">
    <h2>Sell Medicine</h2>
    <?php if(isset($success)){?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?=$success?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <?php } ?>
    
    <?php if(isset($error)){?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><?=$error?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <?php } ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="medicine_id">Medicine:</label>
            <!-- Assuming you have a list of medicines in your database -->
            <select class="form-control" id="medicine_id" name="medicine_id" required>
                <?php
                $salesMedID = isset($_GET['mid'])?$_GET['mid']:0;
                $medicineQuery = "SELECT id, medicine_name FROM medicines";
                $medicineResult = $conn->query($medicineQuery);

                if ($medicineResult->num_rows > 0) {
                    while ($medicineRow = $medicineResult->fetch_assoc()) {
                        echo "<option value='" . $medicineRow["id"] . "'>" . $medicineRow["medicine_name"] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No medicines available</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Sell</button>
    </form>
</div>

<!-- sales table -->
<div class="container mt-5">
    <h2>Sales Report</h2>

    <table id="salesTable" class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Sale Date</th>
                <th>Customer Name</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Fetch sales data from the database
            $sales_query = "SELECT sales.id, sales.sale_date, sales.customer_name, medicines.medicine_name, sales.quantity, sales.total_price
                            FROM sales
                            INNER JOIN medicines ON sales.medicine_id = medicines.id";
            $sales_result = $conn->query($sales_query);

            if ($sales_result->num_rows > 0) {
                while ($row = $sales_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["sale_date"] . "</td>";
                    echo "<td>" . $row["customer_name"] . "</td>";
                    echo "<td>" . $row["medicine_name"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["total_price"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No sales records found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php';?>
