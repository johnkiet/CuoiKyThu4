</div>
<div class="footer">
    <div class="wrapper">
        <div class="section group">
            <div class="col_1_of_4 span_1_of_4">
                <h4>HotLine</h4>
                <ul>
                <li><span>Khiếu nại: 1800.1063 (8:00 - 21:30)</span></li>
                <li><span>Bảo hành: 1800.1065 (8:00 - 21:00)</span></li>

                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4 social-icons" style="padding-top: 20px;" >
                <h4>Follow Us</h4>
                <ul>
                    <li class="facebook"><a href="#" target="_blank"> </a></li>
                    <li class="twitter"><a href="#" target="_blank"> </a></li>
                    <li class="googleplus"><a href="#" target="_blank"> </a></li>
                    <li class="contact"><a href="#" target="_blank"> </a></li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>My account</h4>
                <ul>
                    <li> <?php
                    $login_check = Session::get('customer_login');
                    if ($login_check == false) {
                        echo '<a href="login.php">Login</a>';
                    } else {
                        echo '<a href="?customer_id='.Session::get('customer_id').'">Logout</a>';
                    }
                    ?></li>
                    <li><a href="cart.php">View Cart</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Contact</h4>
                <ul>
                    <li><span>Sđt: 0123456789</span></li>
                    <li><span>Địa Chỉ: số 99 đường số 9 quận 9 Tp.HCM</span></li>
                </ul>

            </div>
        </div>
        <div class="copy_right">
            <p>PrimerLeague thích thì nhích </p>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        /*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(function() {
        SyntaxHighlighter.all();
    });
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>
</body>

</html>