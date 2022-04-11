<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class product
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $product_type = mysqli_real_escape_string($this->db->link, $data['product_type']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['product_image']['name'];
        $file_size = $_FILES['product_image']['size'];
        $file_temp = $_FILES['product_image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $product_type == "" || $file_name == "") {
            $alert = "<span class='error'>add product error!</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product (productName, categoryId, brandId, product_desc, product_type, price, product_image) VALUE ('$productName', '$category', '$brand', '$product_desc', '$product_type', '$price', '$unique_image') ";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert product successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert product not success</span>";
                return $alert;
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT tbl_product.*, tbl_category.categoryName, tbl_brand.brandName
         FROM tbl_product INNER JOIN tbl_category ON tbl_product.categoryId = tbl_category.categoryId
         INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
         ORDER BY tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproductbyid($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getallproduct()
    {
        $sp_tungtrang = 8;
        if (!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tung_trang, $sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteproduct($id)
    {
        $query = "DELETE  FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>delete product successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>delete product not success</span>";
            return $alert;
        }
    }

    public function update_product($data, $files, $id)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $product_type = mysqli_real_escape_string($this->db->link, $data['product_type']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['product_image']['name'];
        $file_size = $_FILES['product_image']['size'];
        $file_temp = $_FILES['product_image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $product_type == "") {
            $alert = "<span class='error'>add product error!</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            if (!empty($file_name)) {
                if ($file_size > 99999999999999999999999999999) {
                    $alert = "<span class='error'>Image size should be less them 2MB!</span>";
                    return $alert;
                } else {
                    if (in_array($file_ext, $permited) === false) {
                        $alert = "<span class='error'>You can upload only :-" . implode(',', $permited) . "</span>";
                        return $alert;
                    }
                }
                $query = "UPDATE tbl_product 
                SET productName = '$productName',
                 brandId = '$brand',
                 categoryId = '$category',
                 product_desc = '$product_desc',
                 price = '$price',
                 product_type = '$product_type',
                 product_image = '$unique_image'
                 where productId = '$id'";
            } else {
                $query = "UPDATE tbl_product 
                SET productName = '$productName',
                 brandId = '$brand',
                 categoryId = '$category',
                 product_desc = '$product_desc',
                 price = '$price',
                 product_type = '$product_type'
                 where productId = '$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>update product successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>update product not success</span>";
                return $alert;
            }
        }
    }

    //website

    public function getproduct_feature()
    {
        $query = "SELECT * FROM tbl_product WHERE product_type = '1' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }


    public function getproduct_new()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }


    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_detail($id)
    {
        $query = "SELECT tbl_product.*, tbl_category.categoryName, tbl_brand.brandName
         FROM tbl_product INNER JOIN tbl_category ON tbl_product.categoryId = tbl_category.categoryId
         INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
         where tbl_product.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompare($productid, $customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link, $productid);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $query_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id = '$customer_id' ";
        $check_compare =  $this->db->select($query_compare);
        if ($check_compare) {
            $alert = "<span style='color:red;font-size:18px;'>Product already added to compare</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId = '$productid' ";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["product_image"];

            $query_insert = "INSERT INTO tbl_compare(productId, price, image, customer_id, productName)
            VALUES ('$productid', '$price', '$image', '$customer_id', '$productName')";
            $insert_compare = $this->db->insert($query_insert);

            if ($insert_compare) {
                $alert = "<span style='color:green;font-size:18px;'>added compare successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;font-size:18px;'>added compare not success</span>";
                return $alert;
            }
        }
    }

    public function get_compare($customer_id)
    {
        $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_wishlist($customer_id)
    {
        $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertWishlist($productid, $customer_id)
    {
        $productid = mysqli_real_escape_string($this->db->link, $productid);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $query_wishlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id' ";
        $check_wishlist =  $this->db->select($query_wishlist);
        if ($check_wishlist) {
            $alert = "<span style='color:red;font-size:18px;'>Product already added to wishlist</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId = '$productid' ";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["product_image"];

            $query_insert = "INSERT INTO tbl_wishlist(productId, price, image, customer_id, productName)
            VALUES ('$productid', '$price', '$image', '$customer_id', '$productName')";
            $insert_wishlist = $this->db->insert($query_insert);

            if ($insert_wishlist) {
                $alert = "<span style='color:green;font-size:18px;'>added to wishlist successful</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;font-size:18px;'>added to wishlist not success</span>";
                return $alert;
            }
        }
    }

    public function deleteWishlist($proID, $customer_id)
    {
        $query = "DELETE  FROM tbl_wishlist WHERE productId = '$proID' AND customer_id='$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function insert_slider($data, $files)
    {
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($sliderName == "" || $type == "") {
            $alert = "<span class='error'>add product error!</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            if (!empty($file_name)) {
                if ($file_size > 99999999999999999999999999999) {
                    $alert = "<span class='error'>Image size should be less them 2MB!</span>";
                    return $alert;
                } else {
                    if (in_array($file_ext, $permited) === false) {
                        $alert = "<span class='error'>You can upload only :-" . implode(',', $permited) . "</span>";
                        return $alert;
                    }
                }
                $query = "INSERT INTO tbl_slider (sliderName, type, sliderImage) VALUE ('$sliderName', '$type', '$unique_image') ";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'>Add slider successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Add slider not success</span>";
                    return $alert;
                }
            }
        }
    }

    public function show_slider()
    {
        $query = "SELECT * FROM tbl_slider WHERE type ='1' ORDER BY sliderId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_slider_list()
    {
        $query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_type_slider($id, $type)
    {
        $type = mysqli_real_escape_string($this->db->link, $type);
        $query = "UPDATE tbl_slider SET type ='$type' WHERE sliderId='$id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function del_slider($id)
    {
        $query = "DELETE  FROM tbl_slider WHERE sliderId = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>delete slider successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>delete slider not success</span>";
            return $alert;
        }
    }

    public function search_product($search){
        $search = $this->fm->validation($search);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$search%' ";
        $result = $this->db->select($query);
        return $result;
    }
}
?>