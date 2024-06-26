<?php
session_start();

require_once 'Connect.php';

$id = $_GET['id'];
echo $id;
$sql = "SELECT * FROM Product WHERE P_ID = :id";
try {
    $stmt = $pdo->prepare($sql);    // prepare SQL for query
    $stmt->bindParam(':id', $id);   // bind parameter :id to $id
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($product);
    // print_r($product);


} catch (PDOException $error) {
    echo $error->getMessage();
}
if (isset($_POST['add_to_cart']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    // values from <form><input name=""></form> /// POST request
    $pro_id = $_POST['id'];
    $pro_name = $_POST['name'];
    $pro_cat = $_POST['type'];
    $pro_price = $_POST['price'];
    $pro_stock = $_POST['stock'];
    $pro_image = $_POST['image'];


    // send values to Cart.php via URL.
    header("Location: AddToCart.php?pro_id=$pro_id&pro_name=$pro_name&pro_type=$pro_cat&pro_price=$pro_price&pro_stock=$pro_stock&pro_image=$pro_image");
}
?>






<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karaweik - Blogs</title>

    <link rel="stylesheet" type="text/css" href="../CSS_Main_File/Home.css">
    <link rel="stylesheet" type="text/css" href="../CSS_Main_File/ViewProduct.css">

</head>

<body class="textformat colorformat bodyformat">
    <div class="container">
        <!--  -->

        <section class="productpage rflex">
            <div class="cat-title">
                <a href="Products.php" class="Pagetitle">
                    <h2>Products</h2>
                </a>
            </div>
            <hr class="titline">
            <br>
            <div>

                <table class="producttab">
                    <tr>
                        <td class="imagetab" valign="top">
                            <div class="slideshow-container welslide">
                                <div class="mySlides fade imgfix2">

                                    <img src="../Images/Products/<?= $product['P_Image'] ?>.jpg">

                                </div>
                            </div>
                        </td>
                        <td rowspan="3" valign="top">
                            <div class="itemtitle">
                                <h2><?= $product['P_Name'] ?></h2>
                                <!-- <img src="../Image/3.5 stars.jpg" class="rating">
                                <h5 class="ratetxt">98 ratings</h5> -->
                            </div>


                            <hr>

                            <table class="detailtab" border="0" cellspacing="0">
                                <tr>
                                    <td class="detailtit"><b>Category:</b></td>
                                    <td class="detailfo"><?= $product['P_Type'] ?></td>
                                    <td class="detailtit"><b>Color:</b></td>
                                    <td class="detailfo"><?= $product['P_Color'] ?></td>
                                    <td class="detailtit"><b>Size:</b></td>
                                    <td class="detailfo"><?= $product['P_Size'] ?></td>
                                    <td class="detailtit"><b>Weight:</b></td>
                                    <td class="detailfo"><?= $product['P_Weight'] ?></td>
                                </tr>

                            </table>
                            <hr>
                            <div class="Descript">
                                <h2>Description</h2>
                                <p><?= $product['P_Description'] ?></p>
                                <!-- <ul>

                                    <li>
                                    
                                    </li>


                                </ul> -->
                            </div>
                            <br>
                            <table class="pricegroup" cellspacing="0">
                                <tr>
                                    <td class="price">
                                        Price
                                    </td>
                                    <td class="tag">
                                        &nbsp&nbsp <?= $product['P_Price'] ?> Ks
                                    </td>
                            </table>
                            <?php if (isset($_SESSION['user'])) : ?>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $product['P_ID'] ?>">
                                    <input type="hidden" name="name" value="<?= $product['P_Name'] ?>">
                                    <input type="hidden" name="price" value="<?= $product['P_Price'] ?>">
                                    <input type="hidden" name="stock" value="<?= $product['P_Stock'] ?>">
                                    <input type="hidden" name="image" value="<?= $product['P_Image'] ?>">
                                    <button name="add_to_cart" class="buybtn">Add To Cart</button>
                                    <button name="fav" class="buybtn">Favorite</button>
                                </form>
                            <?php endif ?>
                        </td>
                    </tr>


                </table>

                <div class="blank">&nbsp</div>
                <span class="blank">&nbsp</span>
                <span class="blank">&nbsp</span>
                <span class="blank">&nbsp</span>

            </div>

        </section>

        <?php require_once 'NormalNavBar.php'; ?>


        <?php require_once 'Footer.php'; ?>
    </div>

</body>

</html>