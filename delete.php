<?php
session_start();
include 'db_con.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the image filename associated with the record
    $sql = "SELECT image FROM info WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $image = $row['image'];

        // Delete the image file from the server
        if (file_exists("upload/" . $image)) {
            unlink("upload/" . $image);
        }

        // Delete the record from the database
        $delete_sql = "DELETE FROM info WHERE id = $id";
        $delete_result = mysqli_query($conn, $delete_sql);

        if ($delete_result) {
            $_SESSION['status'] = "Record deleted successfully";
        } else {
            $_SESSION['status'] = "Failed to delete the record";
        }
    } else {
        $_SESSION['status'] = "Record not found";
    }
} else {
    $_SESSION['status'] = "Invalid request";
}

header('location: view.php');
exit();
