<?php
    Class Model{
        private $server = "localhost";
        private $username = "id17250671_holfter";
        private $password;
        private $db = "id17250671_localhost";
        private $conn;

        public function __construct()
        {
            try{
                $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
            }catch(Exception $e){
                echo "connection failed " . $e->getMessage();
            }
        }

        public function insert(){
            if(isset($_POST['submit'])){
                if(isset($_POST['sku']) 
                && isset($_POST['name']) 
                && isset($_POST['price']) 
                && isset($_POST['types']))
                {
                    if(!empty($_POST['sku']) 
                    && !empty($_POST['name']) 
                    && !empty($_POST['price']) 
                    && !empty($_POST['types']))
                    {
                        $sku = $_POST['sku'];
                        $name = $_POST['name'];
                        $price = $_POST['price'];
                        $type = $_POST['types'];
                        $size = $_POST['size'];
                        $weight = $_POST['weight'];
                        $height = $_POST['height'];
                        $width = $_POST['width'];
                        $length = $_POST['length'];


                        $query = "INSERT INTO products(sku,name,price,type,size,weight,height,width,length) 
                        VALUES('$sku','$name','$price','$type','$size','$weight','$height','$width','$length')";

                        if($sql = $this->conn->query($query)){
                            echo '<script>window.location.href = "index.php";</script>';
                        }else{
                            echo 'failed';
                        }
                    }
                }
            }
        }

        public function fetch(){
            $data = null;

            $query = "SELECT * FROM products ORDER BY id DESC";
            if($sql = $this->conn->query($query)){
                while ($card = mysqli_fetch_assoc($sql)){
                    $data[] = $card;
                }
            }
            return $data;
        }

    }
?>