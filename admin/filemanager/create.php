<?php require('../layouts/header.php'); ?>

<?php require('../layouts/navbar.php'); ?>

<section class="py-5">
    <div class="container">
        <div class="card w-35 mx-auto p-2 ">
            <h3 class="text-center">Add Image</h3>
            <div class="card-body ">
                <?php

                if(isset( $_POST['submit'] )) {
                    $title = $_POST['title'];
                    $file_name = $_FILES['dataFile']['name'];
                    $file_size = $_FILES['dataFile']['size'];
                    $explode = explode('.', $file_name);
                    $file = strtolower($explode[0]);
                    $ext = strtolower($explode[1]);
                    $replace = str_replace(' ','', $file);
                    $final_name = $replace.time().'.'.$ext;
                    $description = $_POST['description'];

                    if($title != "" && $description != "" && $file_name != ""){
                        if($file_size > 200000){
                            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg"){
                                if(move_uploaded_file($_FILES['dataFile']['tmp_name'],'../uploads/'.$final_name)){
                                    $insert = "INSERT INTO files (title, img_link, type, description) VALUES ('$title', '$final_name', '$ext', '$description')";
                                    $result = mysqli_query($con, $insert);
                                    if ($result){
                                        echo "file is submitted";
                                    }
                                    else {
                                        echo "file is not submitted";
                                    }
                                }
                                else{
                                    echo "file is not uploaded";
                                }
                            }
                            else{
                                echo "file extension doesn't match (must be png, jpg, jpeg)";
                            }

                        }
                        else{
                            echo "file size must be more than 2 MB";
                        }
                    }
                    else{
                        echo "All Fields are required!";
                    }
                }

                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input1" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="input1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="input1" class="form-label">Image</label>
                        <input type="file" class="form-control" name="dataFile" id="input1" aria-describedby="emailHelp">
                    </div>
    
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger btn-sm" name="submit">Submit</button>
                    <span> Have already an account <a href="index.php"> Login</a></span>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require('../layouts/footer.php'); ?>