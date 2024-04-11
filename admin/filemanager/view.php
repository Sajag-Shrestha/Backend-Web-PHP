<?php require('../layouts/header.php'); ?>

<?php require('../layouts/navbar.php'); ?>

<section class="py-5">
    <div class="container">
        <div class="card w-35 mx-auto p-2 ">
            <h3 class="text-center">Add User</h3>
            <a class="btn btn-primary btn-sm " href="index.php" role="button">manage Files </a>
            <div class="card-body ">

                <?php

                if (isset($_GET['id'])) {

                    $id = $_GET['id'];
                    $query = "SELECT * FROM files WHERE id=$id";
                    $result = mysqli_query($con, $query);
                    $data = $result->fetch_assoc();
                }

                ?>

               

                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input1" class="form-label">Title</label>
                        <input type="text" class="form-control" readonly name="title" id="input1" value="<?php echo $data['title']; ?>" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="input1" class="form-label">Image </label>
                        <img src="../uploads/<?php echo $data['img_link'];?>" alt="" width="100" height="100">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label"></label>Description
                        <textarea class="form-control" id="exampleFormControlTextarea1" readonly name="description" rows="3"><?php echo $data['description']; ?></textarea>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<?php require('../layouts/footer.php'); ?>