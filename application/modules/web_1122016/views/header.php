<!DOCTYPE html>
<html>
  <?php 
?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/font-awesome.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/bootstrap.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/owl.theme.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/universal/animate.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.universal.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/universal/custom.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/test.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.css">
    <script href="<?php echo base_url();?>assets/dist/js/respond.min.js">
    </script>
    <script href="<?php echo base_url();?>assets/dist/js/respond.min.js">
    </script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/home/slider.css">
    <script href="<?php echo base_url();?>assets/dist/js/slider.js">
    </script>
    <script href="<?php echo base_url();?>assets/dist/js/navbar.js">
    </script>
	<style>
	.carousel-indicators {
    bottom: 0;
	}
	</style>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]--> 
  </head>
  <body>
    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand home" href="<?php echo base_url('web/home')?>">
            <img src="<?php echo base_url();?>assets/svgs/lilme.svg" alt="Obaju logo" class="hidden-xs" style="height: 57px;">
            <img src="<?php echo base_url();?>assets/svgs/lilme.svg" alt="Obaju logo" class="visible-xs" style="height: 57px;">
            <span class="sr-only">Obaju - go to homepage
            </span>
          </a>
          <div class="navbar-buttons">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
              <span class="sr-only">Toggle navigation
              </span>
              <i class="fa fa-align-justify">
              </i>
            </button>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
              <span class="sr-only">Toggle search
              </span>
              <i class="fa fa-search">
              </i>
            </button>
            <a onclick="openNav()" class="btn btn-default navbar-toggle">
              <i class="fa fa-shopping-cart">
              </i>  
              <span class="hidden-xs">3 items in cart
              </span>
            </a>
          </div>
		  
		  
        </div>
        <div class="navbar-collapse collapse" id="navigation">
          <ul class="nav navbar-nav navbar-left">
            <li class="active">
              <a href="<?php echo base_url('web/home')?>">Home
              </a>
            </li>
            <li class="dropdown yamm-fw">
              <a href="<?php echo base_url('web/home/products_list')?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Gallery
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="yamm-content">
				  <div class="row">
                      <div class="col-sm-3">
					   <ul>
				  <?phpfor ($i = 1;$i<=3 ; $i++) {?>
					   <li>
                            <a href="category.html">Baby Girl
                            </a>
                          </li>
				  <?php}?>
                    
                       
                         
                          <li>
                            <a href="category.html">Rompers
                            </a>
                          </li>
                          <li>
                            <a href="category.html">Hampers
                            </a>
                          </li>
                          <li>
                            <a href="category.html">Accessories
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="col-sm-3">
                        <ul>
                          <li>
                            <a href="category.html">Bath Products
                            </a>
                          </li>
                          <li>
                            <a href="category.html">Unisex
                            </a>
                          </li>
                          <li>
                            <a href="category.html">Cottons
                            </a>
                          </li>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
              <!-- /.yamm-content -->
            </li>
          </ul>
          </li>
		   <li class="dropdown yamm-fw">
          <a href="<?php echo base_url('web/home/favorites')?>" class="dropdown-toggle" data-hover="dropdown">Favorites
          </a>
        </li>
        <li class="dropdown yamm-fw">
          <a href="<?php echo base_url('web/home/about_us')?>" class="dropdown-toggle" data-hover="dropdown">About Us 
          </a>
        </li>
        <li class="dropdown yamm-fw">
          <a href="<?php echo base_url('web/home/contact_us')?>" class="dropdown-toggle" data-hover="dropdown">Reach Us 
          </a>
        </li>
        <li class="dropdown yamm-fw">
          <a href="<?php echo base_url('web/home/faqs')?>" class="dropdown-toggle" data-hover="dropdown">FAQs
          </a>
        </li>
        </ul>
    </div>
    <div class="icons_set"  style="float: right;">
      <a  data-toggle="collapse" data-target="#search" >
        <img src="<?php echo base_url();?>assets/svgs/ic_search_white_24px.svg" style="height: 68px;width: 25px;">
      </a>
	  
	  <script  src="<?php echo base_url();?>assets/plugins/fancyBox/lib/jquery-1.10.1.min.js" type="text/javascript"></script>
	
	

	<!-- Add fancyBox main JS and CSS files -->
	<script  src="<?php echo base_url();?>assets/plugins/fancyBox/source/jquery.fancybox.js?v=2.1.5" type="text/javascript"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/fancyBox/source/jquery.fancybox.css?v=2.1.5" media="screen" />


	<script type="text/javascript">
	var jq = $.noConflict();
		jq(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			jq('.fancybox').fancybox({'width':'500',
			'height':'470',
    'autoDimensions':false,
    'type':'iframe',
    'autoSize':false});
			
			});
	</script>
	  
	  
	  <a class="fancybox fancybox.iframe" href="<?php echo base_url('web/signup/login');?>" ><img src="<?php echo base_url();?>assets/svgs/ic_supervisor_account_white_24px.svg" style="height: 68px;width: 25px;"></a>
	  
     
	  
	  <a data-toggle="modal" data-target="#login-modal">
        <img src="<?php echo base_url();?>assets/svgs/ic_supervisor_account_white_24px.svg" style="height: 68px;width: 25px;">
      </a>
	  
      <a onclick="openNav()">
        <img src="<?php echo base_url();?>assets/svgs/ic_add_shopping_cart_white_24px.svg" style="height: 68px;width: 25px;" >
      </a>
    </div>
	 <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search" action="<?php echo base_url('web/home/search')?>">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

		    </span>
                    </div>
                </form>

            </div>
    </div>
  </div>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login"> Login</h4>
                    </div>
                    <div class="modal-body" style="margin-bottom: 13%;">
                        <form action="<?php echo base_url('web/login/login')?>" method="post">
                            <div class="form-group" align="center">
                                <input type="text" class="form-control1" name="username" placeholder="email" required>
                            </div>
                            <div class="form-group" align="center">
                                <input type="password" class="form-control1" name="password" placeholder="password" required>
                            </div>
							<a href="#" style="margin-left: 15%;margin-bottom: 3%;color: #ff66d9;"><span>Forgot Password</span></a>
                            <p class="text-center">
                                <button class="btn btn-info"></i> Log in</button>
							</p>
							<p class="text-center">
								 <button class="btn btn-info"></i> Sign Up</button>
                            </p>
							<hr class="front"></hr><span class="seperator">or</span>
								<div class="social-login" style="padding-left: 10%;">
							
	                        	
								<hr class="back"></hr>
								<br>
	                        	
								<a href="<?php if(isset($authUrl))
									echo $authUrl;
								else
									echo '';?>" class="social-login-icon"><img src="<?php echo base_url();?>assets/svgs/fb.svg"  ><span>Sign in with Facebook</span></a>
								
		                        <a class="social-login-icon"><img src="<?php echo base_url();?>assets/svgs/gplus.svg" ><span>Sign in with Gmail<span></a>	
		                        		
	                        	
	                        </div>
                        </form>

                       
                       

                    </div>
                </div>
            </div>
        </div>
<div id="mySidenav" class="col-sm-6 sidenav">
  <span class="cart_title"> Cart 
  </span>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;
  </a>
  <hr>
  <?php
if(isset($cart_list['data']) && is_array($cart_list['data'])&&(count($cart_list['data'])!="0")) {
	$i=0;
foreach($cart_list['data'] as $cart_row){
?>
  <!--------for loop starts here for making cart cards------------>
  <div class="cartitem" id="<?php echo $cart_row['id'];?>"> 
    <div class="cart-img" style="float: left;">
      <img class="side-img" src="<?php echo $cart_row['image_thumbnail_url']; ?>">
    </div>
    <div class="cart-data">
      <div class="title_row">
        <div class="cart-itemname"> 
          <?php echo $cart_row['product_name']; ?>
        </div>
        <div class="cart-close">
          <a href="#" class="div_close" onclick="hide('<?php echo $cart_row['id'];?>')">
            <img src="<?php echo base_url();?>assets/svgs/close.svg">
          </a>
        </div>
      </div>
      <div class="span_row">
        <span class="quant_span"> Quantity
        </span>
        <span class="size_span">
        </span>
      </div>
      <div class="quant-div">
        <a id="subtract" onclick="decrementValue(<?php echo $cart_row['id'];?>,<?php echo $i ;?>)">
          <img src="<?php echo base_url();?>assets/svgs/minus-circle-outline.svg">
        </a>
        <input class ="quant-text" type="text" id="<?php echo $i ;?>" value="<?php echo $cart_row['quantity'] ;?>">
        <a id="add" onclick="incrementValue(<?php echo $cart_row['id'];?>,<?php echo $i ;?>)">
          <img src="<?php echo base_url();?>assets/svgs/plus-circle-outline.svg">
        </a>
      </div>
      <select class="size" name="size" id="<?php echo $cart_row['id'].'size';?>" onchange="sizeChange(<?php echo $cart_row['id'];?>,this.value)">
        <?php
		foreach($cart_row['size_available'] as $size_id=>$size_title)
		{
		?>
        <option value="<?php echo $size_id;?>"
                <?=$cart_row['size'] == $size_id ? ' selected="selected"' : '';?>>
        <?php echo $size_title?>
        </option>
      <?php }?>
      </select>
    <div class="cart-itemprice">Price:
      <span class="price_tag" id="<?php echo $cart_row['id']."price";?>">&#8377; 
        <?php echo $cart_row['price'];?>  
      </span>
    </div>
  </div>
  <div class="cart-data">
  </div>
</div>
<?php	$i++;
} ?>
<div id="summary_div">
  <div class="cart_no_items" id="cart_no_items">
    <?php echo $cart_list['total_quantity'];?>
  </div>
  <div class="cart_total_amount" id="cart_total_amount">&#8377; &nbsp; 
    <?php echo $cart_list['total_price'];?>
  </div>
</div>
<button class="btn-info place_order_button"type="button">Place Order
</button>
<?Php } 
else{
echo "No data Available";
}
?>
</div>
