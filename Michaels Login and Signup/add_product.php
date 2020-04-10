<html>
    <head>
        <title>Add Product</title>
    </head>
    <body>

        <h2>Add Product</h2>

        <?php
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $rest_id = $_POST['rest_id'];
        $product_desc = $_POST['product_desc'];

        $db_host = "localhost";
        $db_username = "testuser";
        $db_passwd = "password";

        $dbc = mysqli_connect('localhost', 'testuser', 'password', 'addressbook')
                or die("Could not Connect! \n");

        $sql = "INSERT INTO contacts VALUES (NULL,'$product_id','$product_name','$rest_id',NULL);";

        echo "Connection established. \n";

        $result = mysqli_query($dbc, $sql) or die("Error Querying Database");

        mysqli_close();
        ?>

    </body>

</html>