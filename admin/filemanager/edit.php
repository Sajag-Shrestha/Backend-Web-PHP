<?php require('../layouts/header.php'); ?>

<?php require('../layouts/navbar.php'); ?>

<section class="py-5">
    <div class="container">
        <div class="card w-35 mx-auto p-2 ">
            <h3 class="text-center">Add User</h3>
            <div class="card-body ">

                <?php

                if (isset($_GET['id'])) {

                    $id = $_GET['id'];
                    $query = "SELECT * FROM files WHERE id=$id";
                    $result = mysqli_query($con, $query);
                    $data = $result->fetch_assoc();
                }

                ?>

                <?php

                if (isset($_POST['submit'])) {
                    $title = $_POST['title'];
                    $file_name = $_FILES['dataFile']['name'];
                    $file_size = $_FILES['dataFile']['size'];
                    $description = $_POST['description'];
                    
                    // submit previous file
                    if ($title != "" && $file_name == "" && $description!="") {
                        $querry = "UPDATE  files  SET  title='$title', description='$description' WHERE id='" . $id . "'";

                        $result = mysqli_query($con, $querry);
                        if ($result) {
                            echo "Updated title and description";
                        } else
                            echo "not updated";
                    }

                    // submit new file & replace old file
                    if ($title != "" && $file_name!= "" && $description!="") {

                        if ($file_size > 200000) {
                            $explode = explode('.', $file_name); // explode cuts the name after the dot.
                            $file = strtolower($explode[0]);
                            $ext = strtolower($explode[1]);
                            $replace = str_replace(' ', '', $file); //to remove space
                            $finalname = $replace . time() . '.' . $ext; //concating names with time
                            $target_file = '../uploads/' . $finalname;
                            if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {

                                // replace old file
                                $oldfilelink = $data['img_link']; //file link from database
                                $finallink = '../uploads/' . $oldfilelink;
                                unlink($finallink);

                                if (move_uploaded_file($_FILES['dataFile']['tmp_name'], $target_file)) {

                                    $querry = "UPDATE  files  SET  title='$title', img_link='$finalname', type='$ext',description='$description'  WHERE id='$id'";
                                    $result = mysqli_query($con, $querry);
                                    if ($result) {
                                        echo "File uploaded";
                                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
                                    } else {
                                        echo "File is not uploaded";
                                    }
                                } else {
                                    echo "file upload failed";
                                }
                            } else {

                                echo "extension doesn't mattch";
                            }
                        } else {
                ?>
                            <div class="alert alert-primary" role="alert">
                                file size must be less than 2MB
                            </div>

                        <?php

                        }
                    } else {
                        ?>
                        <div class="alert alert-primary" role="alert">
                            Updated Succsefully
                        </div>

                <?php
                        echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
                    }
                }
                ?>



                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input1" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="input1" value="<?php echo $data['title']; ?>" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="input1" class="form-label">Image </label>
                        <img src="../uploads/<?php echo $data['img_link'];?>" alt="" width="100" height="100">
                        <input type="file" class="form-control" name="dataFile" id="input1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label"></label>Description
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"><?php echo $data['description']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-danger btn-sm" name="submit">Submit</button>
                    <span> Have already an account <a href="index.php"> Login</a></span>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require('../layouts/footer.php'); ?>