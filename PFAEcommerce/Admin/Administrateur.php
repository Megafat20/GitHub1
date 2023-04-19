<?php require "Connexion2.php" ?>

<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("location:index.php");
  if(time()-$_SESSION['LAT']>3600) header('location:déconnexion.php');
}



include "./templates/top.php";
include "./templates/navbar.php";
include "./templates/sidebar.php";
include "./templates/footer.php"; ?>
</head>

<body>
  <style>
    body {
      background-image: url('Background.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed
    }
  </style>
  <?php
  $query = "SELECT * FROM `users`";
  $result = mysqli_query($connexion2, $query);
  if (!$result) {
    die("error in query");
  }
  ?>
  <div class="row">
    <div class="col-10">
      <h1> ADMINISTRATEUR </h1>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <th>login</th>
      <th>pass</th>
      <th>name</th>
      <th>active</th>
      <th>Action </th>

      <?php
      while ($prod = mysqli_fetch_array($result)) { ?>

        <tr>
          <td>
            <?php echo $prod['login']; ?>
          </td>
          <td>
            <?php echo $prod['pass']; ?>
          </td>
          <td>
            <?php echo $prod['Name']; ?>
          </td>
          <td>
          </td>
          <td> 
            <a href="editadmin.php?id=<?php echo $prod['login']; ?>"> <img src="../Image/Update.jpg" width=20 height=20></a>
          </td>


        </tr>
        </thead>


      <?php } ?>

    </table>

    <script type="text/javascript" src="../Admin/js/admin.js"></script>