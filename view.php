<?php include './db_con.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>View</title>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-secondary">
                <h4 class="text-center">DATA</h4>
            </div>
            <div class="card-body">
                <a href="index.php" class="btn btn-primary mb-3">Add New</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Country</th>
                            <th>Birth Date</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM info";
                        $result = mysqli_query($conn, $query);
                        $x = 1;
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?php echo $x++; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['country']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td>
                                        <img src="<?php echo "upload/" . $row['image']; ?>" alt="Image" width="100px">
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square mx-2" style="color: #0aa2c0;"></i></a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td>No Data Available</td>
                            </tr>
                        <?php

                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>