
<html>
    <head>
    <link rel="stylesheet" href="index.css">
    </head>

    <script type="text/javascript">
        let check = '';
        function changeContent(){
            let options = document.getElementById('productType');
            let dvd = document.getElementById("DVD");
            let furniture = document.getElementById("Furniture");
            let book = document.getElementById("Book");
            check = options.value;

            if(check == 'DVD'){
                dvd.style.display = "block";
                furniture.style.display = "none";
                book.style.display = "none";
            }else if(check == 'Book'){
                book.style.display = "block";
                dvd.style.display = "none";
                furniture.style.display = "none";
            }else if(check == 'Furniture'){
                furniture.style.display = "block";
                book.style.display = "none";
                dvd.style.display = "none";
            }
        }
        window.onload = changeContent;
    </script>
    <body>
    <?php
        $skuErr = $nameErr = $priceErr = $weightErr = 
        $typeErr = $sizeErr = $weightErr = $heightErr = $widthErr = $lengthErr = "";

        $errors = array('sku'=>'','name'=>'','price'=>'',
        'weight'=>'','height'=>'', 'type'=>'',
        'size'=> '', 'weight'=>'','height'=>'','width'=>'','length'=>'');
        if(isset($_POST['submit'])){
            if(empty($_POST['sku'])){
                $errors['sku'] = "A SKU is required";
            }else{
                $skuErr = $_POST['sku'];
            }

            if(empty($_POST['name'])){
                $errors['name'] = "A name is required";
            }else{
                $nameErr = $_POST['name'];
            }

            if(empty($_POST['price'])){
                $errors['price'] = "A price is required";
            }else{
                $priceErr = $_POST['price'];
                if(!preg_match('/[-+]?[0-9]*\.?[0-9]*^-?\d*\.?\d*$/', $priceErr)){
                    $errors['price'] = "Invalid value";
                }
            }
            if(empty($_POST['types'])){
                $errors['type'] = "Select a type";
            }else{
                $typeErr = $_POST['types'];
            }

            if($_POST['types'] == "DVD"){
                if(empty($_POST['size'])){
                    $errors['size'] = "Please, provide a size";
                }
            }else{
                $sizeErr = $_POST['size'];
            }

            if($_POST['types'] == "Book"){
                if(empty($_POST['weight'])){
                    $errors['weight'] = "Please, provide weight";
                }
            }else{
                $weightErr = $_POST['weight'];
                if(!preg_match('/[-+]?[0-9]*\.?[0-9]*^-?\d*\.?\d*$/', $weightErr)){
                    $errors['weight'] = "Invalid value";
                }
            }

            if($_POST['types'] == "Furniture"){
                if(empty($_POST['height'])){
                    $errors['height'] = "Please, provide height";
                }else{
                    $heightErr = $_POST['height'];
                    if(!preg_match('/[-+]?[0-9]*\.?[0-9]*^-?\d*\.?\d*$/', $heightErr)){
                        $errors['height'] = "Invalid value";
                    }
                }

                if(empty($_POST['width'])){
                    $errors['width'] = "Please, provide width";
                }else{
                    $widthErr = $_POST['width'];
                    if(!preg_match('/[-+]?[0-9]*\.?[0-9]*^-?\d*\.?\d*$/', $widthErr)){
                        $errors['width'] = "Invalid value";
                    }
                }
                if(empty($_POST['length'])){
                    $errors['length'] = "Please, provide length";
                }else{
                    $lengthErr = $_POST['length'];
                    if(!preg_match('/[-+]?[0-9]*\.?[0-9]*^-?\d*\.?\d*$/', $lengthErr)){
                        $errors['length'] = "Invalid value";
                    }
                }
            }

            if(array_filter($errors)){
                //
            }else{
                include 'model.php';
                $model = new Model();
                $model->insert();
            }
            
        }
    ?>
    
    <form id="product_form" action="" method="POST">
        <div class="header">
            <h1>Product Add</h1>
            <div>
                <input class="add" type="submit" name="submit" value="Save">
                <a href="index.php" id="cancel">CANCEL</a>
            </div>
        </div>

        <div class="form-content">
            <span class="spanStyle">
                <label>SKU</label>
                <div class="warning"><?php echo $errors['sku'];?></div>
                <input id="sku" type="text" name="sku" value="<?php echo $skuErr;?>">
            </span>
            <span class="spanStyle">
                <label>Name</label>
                <div class="warning"><?php echo $errors['name']?></div>
                <input id="name" type="text" name="name" value="<?php echo $nameErr;?>">
            </span>
            <span class="spanStyle">
                <label>Price ($)</label>
                <div class="warning"><?php echo $errors['price']?></div>
                <input id="price" type="text" name="price" value="<?php echo $priceErr;?>">
            </span>

            <span>
                <form action="" method="POST">
                    <label>Type Switcher</label>
                    <div class="warning"><?php echo $errors['type']?></div>
                    <select id="productType" name="types" onchange="changeContent()">
                        <option value="">---Select---</option>
                        <option <?php echo $typeErr == 'DVD' ? 'selected' : ''?> value="DVD">DVD</option>
                        <option <?php echo $typeErr == 'Book' ? 'selected' : ''?> value="Book">Book</option>
                        <option <?php echo $typeErr == 'Furniture' ? 'selected' : ''?> value="Furniture">Furniture</option>
                    </select>
                    <div class="typeSwitcherContent">
                        <span id='DVD' class="size">
                            <label>Size (MB)</label>
                            <div class="warning"><?php echo $errors['size']?></div>
                            <input id="size" type="text" name="size">
                        </span>
                        <span id="Furniture" class="furniture">
                            <span>
                                <label>Height (CM)</label>
                                <div class="warning"><?php echo $errors['height']?></div>
                                <input id="height" type="text" name="height">
                            </span>
                            <span>
                                <label>Widht (CM)</label>
                                <div class="warning"><?php echo $errors['width']?></div>
                                <input id="width" type="text" name="width">
                            </span>
                            <span>
                                <label>Lenght (CM)</label>
                                <div class="warning"><?php echo $errors['length']?></div>
                                <input id="length" type="text" name="length">
                            </span>
                            
                        </span>
                        <span id="Book" class="book">
                            <label>Weight (KG)</label>
                            <div class="warning"><?php echo $errors['weight']?></div>
                            <input id="weight" type="text" name="weight">
                        </span>
                    </div>
                </form>
            </span>
        </div>

        
    </form>
    <div class="footer">
        <div>Scandiweb Test assignment</div>
    </div>
</body>
</html>
