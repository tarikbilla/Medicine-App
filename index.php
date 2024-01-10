<?php include 'header.php';?>
<div class="container mt-5">
    <h2>Medicine List</h2>
    <table id="medicineTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Added Datetime</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch data from the medicines table
            $sql = "SELECT * FROM medicines";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["medicine_name"] . "</td>";
                    echo "<td>" . $row["medicine_added_datetime"] . "</td>";
                    echo "<td>" . $row["medicine_description"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["medicine_status"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No medicines found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php';?>

