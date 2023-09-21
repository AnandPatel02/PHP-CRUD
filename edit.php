<?php
session_start();
include 'db_con.php';

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve data from the database based on the ID
    $sql = "SELECT * FROM info WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Assign data to variables
        $name = $row['name'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $gender = $row['gender'];
        $country = $row['country'];
        $dob = $row['dob'];
        $hobbies = explode(', ', $row['hobbies']); // Convert hobbies back to an array
        $image = $row['image'];
    } else {
        $_SESSION['status'] = "Record not found";
        header('location:index.php');
        exit();
    }
} else {
    $_SESSION['status'] = "Invalid request";
    header('location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Form</title>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Form</h4>
            </div>
            <div class="card-body">
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mobile</label>
                        <input type="number" class="form-control" name="mobile" value="<?php echo $mobile; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo $row['password']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" value="<?php echo $row['password']; ?>" required>
                    </div>

                    <fieldset class="mb-3">
                        <legend class="form-label">Gender</legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" <?php if ($gender == 'male') echo 'checked'; ?> required>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="female" <?php if ($gender == 'female') echo 'checked'; ?> required>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="other" <?php if ($gender == 'other') echo 'checked'; ?> required>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Other
                            </label>
                        </div>
                    </fieldset>

                    <div class="mb-3">
                        <label for="" class="form-label">Country</label>
                        <select class="form-select form-select-md mb-3" name="country" required>
                            <?php
                            include 'data.php';
                            foreach ($countries as $countryOption) {
                                // Check if the current country option matches the retrieved country
                                $isSelected = ($countryOption == $country) ? 'selected' : '';

                                echo "<option value='$countryOption' $isSelected>$countryOption</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">DOB</label>
                        <input type="date" class="form-control" name="dob" value="<?php echo $dob; ?>" required>
                    </div>
                    <div class="mb-3" id="hobbies-container">
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="cricket" <?php if (in_array('cricket', $hobbies)) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Cricket
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="dancing" <?php if (in_array('dancing', $hobbies)) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Dancing
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="singing" <?php if (in_array('singing', $hobbies)) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Singing
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="other" <?php if (in_array('other', $hobbies)) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Other
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <img src="upload/<?php echo $image; ?>" alt="Image" class="img-thumbnail" width="150">
                        <input type="file" class="form-control" accept="image/*" name="image">
                    </div>
                    <input type="hidden" name="old_image" value="<?php echo $image; ?>">

                    <input type="submit" class="btn btn-primary" value="UPDATE" name="btn_update">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
