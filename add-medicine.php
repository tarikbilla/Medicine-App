<?php include 'header.php';?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $medicine_name = $_POST["medicine_name"];
    $medicine_description = $_POST["medicine_description"];
    $price = $_POST["price"];
    $medicine_status = $_POST["medicine_status"];

    // Insert data into the medicines table
    $sql = "INSERT INTO medicines (medicine_name, medicine_added_datetime, medicine_description, price, medicine_status)
            VALUES ('$medicine_name', '$medicine_added_datetime', '$medicine_description', '$price', '$medicine_status')";

    if ($conn->query($sql) === TRUE) {
        $success = "Medicine added successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<div class="container">

    <div class="container mt-5">
    <h2>Add Medicine</h2>
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
            <label for="medicine_name">Medicine Name:</label>
            <input type="text" class="form-control" id="medicine_name" name="medicine_name" required>
        </div>
        <div class="form-group">
            <label for="medicine_description">Medicine Description:</label>
            <textarea class="form-control" id="medicine_description" name="medicine_description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="medicine_status">Medicine Status:</label>
            <select class="form-control" id="medicine_status" name="medicine_status" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Medicine</button>
    </form>
</div>

  
</div>
<?php include 'footer.php';?>

