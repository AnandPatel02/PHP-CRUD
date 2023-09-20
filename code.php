<?php
session_start();
include 'db_con.php';

if (isset($_POST['btn_submit'])) {
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $gender = $_POST['gender'];
  $country = $_POST['country'];
  $dob = $_POST['dob'];
  $hobbies = $_POST['hobbies'];
  $multi_hobbies = implode(", ", $hobbies);
  $image = $_FILES['image']['name'];


  if (file_exists("upload/" . $_FILES['image']['name'])) {
    $fileName = $_FILES['image']['name'];
    $_SESSION['status'] = "Image Already Exists";
    header('location:index.php');
  } else {
    if (($password == $confirm_password) && strlen($password) >= 8) {
      $sql = "INSERT INTO info(name,mobile,email,password,gender,country,dob,hobbies,image) VALUES('$name','$mobile','$email','$password','$gender','$country','$dob','$multi_hobbies','$image')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], "upload/" . $_FILES['image']['name']);
        $_SESSION['status'] = "Form Submit Successfully";
        header('location:index.php');
      } else {
        $_SESSION['status'] = "Form Not Submitted";
        header('location:index.php');
      }
    } else {
      header('location:index.php');
      $_SESSION['status'] = "Something Was Wrong! Please Try Again";
    }
  }
}

if (isset($_POST['btn_update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $gender = $_POST['gender'];
  $country = $_POST['country'];
  $dob = $_POST['dob'];
  $hobbies = $_POST['hobbies'];
  $multi_hobbies = implode(", ", $hobbies);

  if (!empty($_FILES['image']['name'])) {
    $old_image = $_POST['old_image'];
    if (file_exists("upload/" . $old_image)) {
      unlink("upload/" . $old_image);
    }

    // Upload New Image
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "upload/" . $image);
  } else {
    // If There Is No New Image, Then Use Old Image
    $image = $_POST['old_image'];
  }


  if (($password == $confirm_password) && strlen($password) >= 8) {
    $sql = "UPDATE info SET name='$name', mobile='$mobile', email='$email', password='$password', gender='$gender', country='$country', dob='$dob', hobbies='$multi_hobbies', image='$image' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header('location: view.php');
    } else {
      $_SESSION['status'] = "Record not updated";
      header('location: edit.php');
    }
  } else {
    $_SESSION['status'] = "Passwords do not match or Length Is Not >= 8 ";
    header('location: edit.php?id=' . $id);
  }
} else {
  header('location: view.php');
  // $_SESSION['status'] = "Invalid request";
}
