<?php 
    session_start();

    $page_title = "Login Page";
    include('include/header.php');
    include('include/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <?php
                        if(isset($_SESSION['status'])){
                            ?>
                            <div class="alert alert-success">
                                <h5><?= $_SESSION['status']; ?> </h5>

                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                    ?>
                    
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="">
                      
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                         
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('include/footer.php')?>