<!DOCTYPE html>
<html>

<head>

    <title> Page d'acceuil</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <script language="javascript">
        function visible() {
            if (document.getElementById('check').checked == true)
                document.getElementById('v').type = "text";
            else
                document.getElementById('v').type = "password";

        }
    </script>
    <script language="javascript">
        function translat() {
            document.forms['frm'].submit();
        }
    </script>

    <div class="body">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Fast In Shop</h2>

            </div>
            <div class="menu">
                <ul>
                    <li><a href="accueil.php">HOME</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="Contact.php">CONTACT</a></li>
                </ul>
            </div>
            <div class="search">
                <input class="srch" type="search" name="" placeholder="Type to search">
                <a href="#"><button class="btn">search</button></a>

            </div>
        </div>
        <div class="content">
            <h1> WELCOME TO <br>OUR WEB SITE </h1>
            <p class="par"> <br><b> Un site attractif qui vous facilitera la vie.
                    <br> Vous y trouverai de bons plans </b>
            </p>
            <button class="cn"><a href="Contact.php">JOIN US</a></button>
        </div>
    </div>

</body>


</html>