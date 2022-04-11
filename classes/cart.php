<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class cart
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sessionId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select($query)->fetch_assoc();

        $images = $result['product_image'];
        $price = $result['price'];
        $productName = $result['productName'];

        $query_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sessionId = '$sessionId' ";
        $check_cart =  $this->db->select($query_cart);
        if ($check_cart) {
            $alert = "<span style='color:red;font-size:18px;'>update cart not success</span>";
            return $alert;
        } else {
            $query_addcart = "INSERT INTO tbl_cart(productId, quantity, sessionId, images, price, productName)
         VALUES ('$id', '$quantity', '$sessionId', '$images', '$price', '$productName')";
            $insert_cart = $this->db->insert($query_addcart);
            if ($result) {
                header('Location:cart.php');
            } else {
                header('Location:404.php');
            }
        }
    }
    public function getproduct_cart()
    {
        $sessionId = session_Id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $alert = "<span style='color:red;font-size:18px;'>update cart not success</span>";
            return $alert;
        }
    }

    public function deleteCart($id)
    {
        $query = "DELETE  FROM tbl_cart WHERE cartId = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location:cart.php');
        } else {
            $alert = "<span class='error'>delete product not success</span>";
            return $alert;
        }
    }

    public function deleteCompare($customer_id){
        $sessionId = session_id();
        $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id' ";
        $result = $this->db->delete($query);
        return $result;
    }

    public function deleteCartSS()
    {
        $sessionId = session_id();
        $query = "DELETE  FROM tbl_cart WHERE sessionId = '$sessionId' ";
        $result = $this->db->delete($query);
        return $result;
    }

    public function insertOrder($customer_id)
    {
        $sessionId = session_id();
        $query = "SELECT *  FROM tbl_cart WHERE sessionId = '$sessionId' ";
        $get_product = $this->db->delete($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productid = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] *$quantity;
                $image = $result['images'];
                $customer_id = $customer_id;
                $query_addorder = "INSERT INTO tbl_order(productId, productName, quantity, image, price, customer_id)
         VALUES ('$productid', '$productName', '$quantity', '$image', '$price', '$customer_id')";
                $insert_Order = $this->db->insert($query_addorder);
            } 
        }
        return $insert_Order;
    }

    public function check_cart()
    {
        $sessionId = session_id();
        $query = "SELECT *  FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_order($customer_id)
    {
        $sessionId = session_id();
        $query = "SELECT *  FROM tbl_order WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_amount($customer_id)
    {
        $query = "SELECT price  FROM tbl_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    public function getcart_orderdetail($customer_id)
    {
        $query = "SELECT *  FROM tbl_order WHERE customer_id = '$customer_id'";
        $getcart_orderdetail = $this->db->select($query);
        return $getcart_orderdetail;
    }
    
    public function get_inbox_Cart(){
        $query = "SELECT *  FROM tbl_order ORDER BY date_order";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart; 
    }

    public function shifted($id, $time, $price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span style='color:blue;font-size:18px;'>update order success</span>";
            return $alert;
        } else {
            $alert = "<span style='color:red;font-size:18px;'>update order not success</span>";
            return $alert;
        }
    }

    public function del_shifted($id, $time, $price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "DELETE FROM tbl_order WHERE id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span style='color:blue;font-size:18px;'>delete order success</span>";
            return $alert;
        } else {
            $alert = "<span style='color:red;font-size:18px;'>delete order not success</span>";
            return $alert;
        }   
    }

    public function shifted_confirm($id, $time, $price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET status = '2' WHERE customer_id = '$id' AND date_order='$time' AND price ='$price'";
        $result = $this->db->update($query); 
        
        return $result;
    }
}
?>