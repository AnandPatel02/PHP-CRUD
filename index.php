<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CRUD</title>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Registration Form</h4>
            </div>
            <div class="card-body">
                <?php
                 if(isset($_SESSION['status']) && $_SESSION != ''){
                    ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong>
                    <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php
                    unset($_SESSION['status']);
                } ?>

                <form action="code.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mobile</label>
                        <input type="number" class="form-control" name="mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                    <fieldset class="mb-3">
                        <legend class="form-label">Gender</legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" required>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="female" required>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="other" required>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Other
                            </label>
                        </div>
                    </fieldset>

                    <div class="mb-3">
                        <select class="form-select form-select-md mb-3" name="country" required>
                            <option selected>Select Country</option>
                            <?php
                            include 'data.php';
                             foreach($countries as $country){
                                ?> <option value="<?php echo $country; ?>"><?php echo $country; ?>
                            </option>
                            <?php
                                 } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">DOB</label>
                        <input type="date" class="form-control" name="dob" required>
                    </div>
                    <div class="mb-3" id="hobbies-container">
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="cricket">
                            <label class="form-check-label" for="flexCheckChecked">
                                Cricket
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="dancing">
                            <label class="form-check-label" for="flexCheckChecked">
                                Dancing
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="singing">
                            <label class="form-check-label" for="flexCheckChecked">
                                Singing
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" type="checkbox" value="other">
                            <label class="form-check-label" for="flexCheckChecked">
                                Other
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" accept="image/*" name="image" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="SUBMIT" name="btn_submit">
                    <input type="reset" class="btn btn-secondary" value="RESET">
                </form>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>