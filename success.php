<?php
include 'inc/header.php'
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<style>
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }
    .wrapper_method {
        width: 550px;
        margin: 0 auto;
        border: 1px solid #666;
        padding: 20px;
        background: cornsilk;
    }
    .wrapper_method {
        text-align: center;
        border: 1px solid #818181;
        margin: auto;
        background: burlywood;
    }
    .wrapper_method a {
        padding: 10px;
        background: red;
        color: #fff;
    }
    .wrapper_method h3 {
        margin-bottom: 20px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment OK</h3>
                    <?php
                    $customer_id = session::get('customer_id');
                        $get_amount = $ct->get_amount($customer_id);
                        if($get_amount){
                            $amount = 0;
                            while($result = $get_amount->fetch_assoc()){
                                $price = $result['price'];
                                $amount += $price;
                            }
                        }
                    ?>
                    <p>Your total order value is: <?php $vat = $amount * 0.1; $total = $vat + $amount; echo $fm->format_currency($total); ?> vnd</p>
                    <p>We will contact you as soon as possible. You can review your order <a href="detail_order.php">here!</a></p>
                </div>
                <div class="clear"></div>
            </div>
            </div>
            
        </div>
    </div>
</div>
<?php
include 'inc/footer.php'
?>