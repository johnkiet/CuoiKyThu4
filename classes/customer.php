<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class customer
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_customer($data)
    {
        $Name = mysqli_real_escape_string($this->db->link, $data['Name']);
        $Address = mysqli_real_escape_string($this->db->link, $data['Address']);
        $City = mysqli_real_escape_string($this->db->link, $data['City']);
        $Country = mysqli_real_escape_string($this->db->link, $data['Country']);
        $Zip_Code = mysqli_real_escape_string($this->db->link, $data['Zip_Code']);
        $EMail = mysqli_real_escape_string($this->db->link, $data['EMail']);
        $Phone = mysqli_real_escape_string($this->db->link, $data['Phone']);
        $Password = mysqli_real_escape_string($this->db->link, md5($data['Password']));

        if ($Name == "" || $Address == "" || $City == "" || $Country == "" || $Zip_Code == "" || $EMail == "" || $Phone == "" || $Password == "") {
            $alert = "<span style='color:red;font-size:18px;'>must be not empty</span>";
            return $alert;
        } else {
            $checkmail = "SELECT * FROM tbl_customer WHERE email = '$EMail' ";
            $result_checkmail = $this->db->select($checkmail);
            if ($result_checkmail) {
                $alert = "<span style='color:red;font-size:18px;'>email in database</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer (name,address,zip_code,phone,email,password,city,country) VALUE ('$Name','$Address','$Zip_Code','$Phone','$EMail','$Password','$City','$Country') ";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span style='color:green;font-size:18px;'>Insert customer successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span style='color:red;font-size:18px;'>Insert customer not success</span>";
                    return $alert;
                }
            }
        }
    }

    public function login_customer($data)
    {

        $EMail = mysqli_real_escape_string($this->db->link, $data['Username']);
        $Password = mysqli_real_escape_string($this->db->link, md5($data['PasswordLG']));

        if (empty($EMail) || empty($Password)) {
            $alert = "User and Pass must be not empty";
            return $alert;
        } else {
            $checkLogin = "SELECT * FROM tbl_customer WHERE email = '$EMail' AND password = '$Password'";
            $result_checkmail = $this->db->select($checkLogin);
            if ($result_checkmail) {
                $value = $result_checkmail->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['customer_id']);
                Session::set('customer_name', $value['name']);
                header('Location:cart.php');
            } else {
                $alert = "User and Pass is not correct ";
                return $alert;
            }
        }
    }

    public function show_customers($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE customer_id = '$id' ";
        $resultI4 = $this->db->select($query);
        return $resultI4;
    }

    public function update_customers($data, $id)
    {
        $Name = mysqli_real_escape_string($this->db->link, $data['name']);
        $Address = mysqli_real_escape_string($this->db->link, $data['address']);
        $City = mysqli_real_escape_string($this->db->link, $data['city']);
        $Country = mysqli_real_escape_string($this->db->link, $data['country']);
        $Zip_Code = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $EMail = mysqli_real_escape_string($this->db->link, $data['email']);
        $Phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if ($Name == "" || $Address == "" || $City == "" || $Country == "" || $Zip_Code == "" || $EMail == "" || $Phone == "") {
            $alert = "<span style='color:red;font-size:18px;'>must be not empty</span>";
            return $alert;
        } else {
            
            $query = "UPDATE tbl_customer 
                SET name = '$Name',
                address = '$Address',
                city = '$City',
                country = '$Country',
                zip_code = '$Zip_Code',
                email = '$EMail',
                phone = '$Phone'
                where customer_id = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='color:red;font-size:18px;'>update customer not success</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;font-size:18px;'>update customer not success</span>";
                return $alert;
            }
        }
    }
}
?>