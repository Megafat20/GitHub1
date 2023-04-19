<?php


require 'Connexion2.php';
$num = $_GET['id'];
$query = "SELECT * FROM users
		WHERE login='$num'";
$result = mysqli_query($connexion2, $query);
if ($result) {

    $prod = mysqli_fetch_array($result);
}
?>
<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>


<div class="container">
    <div class="row justify-content-center" style="margin:100px 0;">
        <div class="col-md-4">

            <form id="admin-register-form"" action=" updfournisseurs.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="login">login</label>
                            <input type="text" class="form-control" name="login" value="<?php echo $prod['login'];?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="pass" value="<?php echo $prod['pass']; ?>" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Name">Full Name</label>
                            <input type="text" class="form-control" name="Name" value="<?php echo $prod['Name']; ?>"/>

                        </div>
                    </div>
                  




                    <input type="hidden" name="add_product" value="1">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary add-product"> <input type="submit" Name="valider" value="Add modification" ></button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/main.js"></script>