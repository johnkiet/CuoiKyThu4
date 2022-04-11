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
    h3.payment{
        text_align: center;
        font_size: 20px;
        font_weight: bold;
        text_decoration: underline;
    }

    .wrapper_method{
        text_align: center;
        width: 550px;
        margin: 0 auto;
        border: 1px solid #666;
        padding: 20px;
        background: cornsilk;
    }

    .wrapper_method a {
        padding: 10px;
        background: red;
        color: #fff;
    }

	.wrapper_method h3 {
        margin_bottom: 20px;
    }
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div class= "wrapper_method">
                    <h3 class="payment">Online Payment</h3>
                    <p> <a class="btn btn-success" href="onlinecart.php">MOMO Payment</a></p>
                    <a  style="background:grey" href="cart.php"> << Previous </a>
                <div class="clear"></div>
            </div>
            </div>
            
        </div>
    </div>
</div>