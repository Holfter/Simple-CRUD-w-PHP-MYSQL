
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Location" content="https://irrigable-chain.000webhostapp.com/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-App Scandiweb</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form action="" method="POST">
        <div class="header">
            <h1>Product List</h1>
            <div>
                <a class="add" href="add-product.php">ADD</a>
                <input id="delete-product-btn" type="submit" value="MASS DELETE" name="delete">
            </div>
        </div>
        <div class="items">
            <?php
                include 'model.php';
                $model = new Model();
                $cards = $model->fetch();
                $i = 1;
                if(!empty($cards)){
                    foreach($cards as $card){
                
            ?>
            
                <div class="cardItem">
                    <div style="width: 100%;padding-left: 20px;"><input id="delete-checkbox" type="checkbox" name='checkbox[]' value="<?php echo $card['id'];?>"></div>
                    <div><?php echo $card['sku'];?></div>
                    <div><?php echo $card['name'];?></div>
                    <div><?php echo '$'.$card['price'];?></div>
                    <div><?php echo $card['type'];?></div>
                    <div><?php echo $card['size'] == "" ? '' : 'Size: '.$card['size'].'MB';?></div>
                    <div><?php echo $card['weight'] == "" ? '' : $card['weight'].'Kg';?></div>
                    <div><?php 
                            if($card['height'] and $card['width'] and $card['length'] != ''){
                                echo 'Dimensions: '.$card['height'].'x'.$card['width'].'x'.$card['length'];
                            }
                        ?>
                    </div>
                    
                </div>
                <?php
                    }
                }
                ?>

            <?php
                if(isset($_POST['delete'])){
                    $conn = mysqli_connect('localhost',"id17250671_holfter","Holfter$12345","id17250671_localhost");
                    $chkarr = $_POST['checkbox'];
                    foreach($chkarr as $id){
                        mysqli_query($conn,"DELETE FROM products WHERE id=".$id);
                    }

                    echo '<script>window.location.href = "index.php";</script>';
                }
            ?>

        </div>
    </form>
    <div class="footer">
        <div>Scandiweb Test assignment</div>
    </div>
</body>
</html>



















