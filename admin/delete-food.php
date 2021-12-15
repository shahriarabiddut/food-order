<?php
    //Include Constants.php file here fore database connection
    include('../config/constants.php');
    include('../admin/partials/login-check.php'); 
    ?>
    <?php 
    //Check Whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //Remove the physical image file
        if($image_name!=""){
            //Image is available and remove it
            $path = "../images/food/".$image_name;
            //Remove the image
            $remove = unlink($path);
            //If failed to remove add an error message
            if($remove==false){
                //Set the session message and Redirect and stop the process!
                $_SESSION['delete'] = "<p class='btn-danger'>Food Image Deletion Failed , Error </p>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn,$sql);
        if($res==true)
        {
            $_SESSION['delete'] = "<p class='btn-primary'>Food Deleted Successfully</p>";
            header('location:'.SITEURL.'admin/manage-food.php');
        } else {
            $_SESSION['delete'] = "<p class='btn-danger'>Food Deletion Failed , Try Again Later</p>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        
    }
    else{
        //Redirect to category page
        //2.2.1:Create Session Variable to Display Message
        $_SESSION['delete'] = "<p class='btn-danger'>Food Deletion Failed , Try Again </p>";
        //2.2.2: Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    ?>
    