<?php session_start();
if(!isset($_SESSION['an'])){
    header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Product</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<style>
        
        .form{
            width: 50%;
    margin: 10px auto;
    height: 80vh;
    display: flex;
    background-color: #5276f0b3;
    flex-direction: column;
    justify-content: space-evenly;
    padding: 40px;
    color: #fff;
    border-radius: 10px;
    box-shadow: inset 0px 1px 8px 2px #00000030;
    border: 1px solid orangered;
}
        .inline{
            display: flex;
        }
        input[type="text"]{
            padding: 10px 8px;
            border-radius: 10px;
            border: none;
        }
        input[type="email"]{
            padding: 10px 8px;
            border-radius: 10px;
            border: none;
        }
        #stream{
            padding: 10px 8px;
            border-radius: 10px;
            border: none;
        }
        input[type="submit"]{
            padding: 10px 8px;
            border-radius: 10px;
            border: none;
        }
        #save{
            margin-top: 20px;
            background-color: #5276f0b3;
            color: #fff;
            transition: .3s;
            border: 1px solid orangered;
        }
        #save:hover{
            background-color: rgb(220, 220, 16);
            color: black;
        }
    </style>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("common/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
        <?php include("common/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                

    <form action="ins.php" method="post" class="form" enctype="multipart/form-data">
        <h1 style="text-decoration: underline;">Product Add Form</h1>
        <h6 class="text-danger">All * marks are required fields</h6>
        <label for="name">Product Name*</label>
        
        <input type="text" name="product" id="name" placeholder="Enter Your Product Name" required>
        <br>
        <label for="price">Price*</label>
        
        <input type="number" name="price" id="price" placeholder="Enter Your Product Price" required>
        <br>
        <label for="desc">Description*</label>
   
        <textarea name="desc" id="desc"  placeholder="Enter your Description" required></textarea>
        
        <label for="img">Upload Image*</label>
        <input type="file" name="img" id="img" require>  
        <input type="submit" name="submit" value="SUBMIT" id="save">
    </form>
            <!-- End of Main Content -->

            <!-- Footer -->
                    <?php include("common/footer.php") ?>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>