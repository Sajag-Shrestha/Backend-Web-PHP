<?php require('../layouts/header.php'); ?>

<?php require('../layouts/navbar.php'); ?>

<section class="py-5">
    <div class="container">
        <div class="card w-35 mx-auto p-2 ">
            <h3 class="text-center">Add Teacher</h3>
            <div class="card-body ">

                <?php

                if (isset($_POST['register'])) {
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $faculty = $_POST['faculty'];
                    $address = $_POST['address'];

                    if ($name != "" && $address != "" && $phone != "" && $email != "" && $faculty !="") {
                        $insert = "INSERT INTO teachers (name, phone, email, faculty, address)
        VALUES('$name', '$phone', '$email', '$faculty', '$address')";
                        $result = mysqli_query($con, $insert);

                        if ($result) {
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>teacher is created</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            header("Refresh:2; URL=index.php?success");

                        } else {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>User is not created</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            header("Refresh:2; URL=create.php?error");
                        }
                    } else {

                        header("Refresh:0; URL=create.php?empty");
                    }
                }

                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="input1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="input1" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="input1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="input1" class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone" id="input1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Faculty</label>
                        <input type="text" class="form-control" name="faculty" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-danger btn-sm" name="register">Submit</button>
                    <span> Have already an account <a href="index.php"> Login</a></span>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require('../layouts/footer.php'); ?>