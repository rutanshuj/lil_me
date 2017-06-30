<!DOCTYPE html>
<html>
  <?php 
  /* echo"<pre>";
		print_r($authUrl);
		echo"</pre>"; 
		die(); */
?>
  <head>
  <?php 
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0 ");
session_cache_limiter("private_no_expire");?>
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
	<link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/font-awesome.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/bootstrap.min.css">
	<!-- Latest compiled and minified CSS -->

    <!-- iCheck <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script> -->
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/owl.theme.css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/universal/animate.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.universal.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/universal/custom.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/test.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.css">
	
	<script href="<?php echo base_url();?>assets/dist/js/bootstrap-multiselect.js"></script>
    <script href="<?php echo base_url();?>assets/dist/js/respond.min.js">
    </script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/home/slider.css">
	<script href="<?php echo base_url();?>assets/dist/js/slider.js">
    </script>
	<script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/bootstrap-multiselect.css">
	
	<style>
	.carousel-indicators {
    bottom: -60px;
	}
	input[type=number]::-webkit-inner-spin-button,  
input[type=number]::-webkit-outer-spin-button {  

   opacity: 1;

}

@media (max-width: 768px) {
  .multiselect{
    width:100%
  }
    .navbar-buttons,.resp_menu
	{
	display:block!important 
	}
	
}
#user_settings
{
	display:none
}
img{
	position: relative;
}



	</style>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]--> 
	<script>
  $(document).ready(function(){
  $(".num").click(function () {
	var i=1;
  $(".content:first").clone().appendTo(".content"); 
  
});
});
  </script>
  </head>
  <body>
<div class="navbar navbar-default yamm" role="navigation" id="navbar" style="position: fixed;top: 0;left: 0;right: 0;z-index: 20;">
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
	   
	  <script  src="<?php echo base_url();?>assets/plugins/fancyBox/lib/jquery-1.10.1.min.js" type="text/javascript"></script>
	
	  </div>
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
    'autoSize':false

		});
			
			});
			
	</script>	  
		  
        </div>
        <div class="navbar-collapse collapse" id="navigation">
          <ul class="nav navbar-nav navbar-left">
            <li class="dropdown yamm-fw <?php if($page_name=="home"){
							echo "active";
							}?>" >
              <a href="<?php echo base_url('web/home')?>" class="dropdown-toggle" data-hover="dropdown"><span class='skew_it'>Home</span>
              </a>
            </li>
            <li class="dropdown yamm-fw <?php if($page_name=="gallery"){
							echo "active";
							}?>">  
              <a href="<?php echo base_url('/products/')?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
			  <span class='skew_it'>Gallery</span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="yamm-content">
				  <div class="row">
                      <div class="col-sm-3">
					  	  <?php if(is_array($category_list)&&(count($category_list)!="0")) {
						foreach($category_list as $category_row){ ?>
					   <ul>
					   
			
					   <li>
                            <a href="<?php echo base_url('products/').'/'.$category_row->category_slug?>"><?php echo $category_row->category_name?></a>
                          </li>
				  <?php } ?>
				 
                    
                       
                         </ul>
						 <?php }?>
                      </div>
                     
                  </div>
                </div>
              <!-- /.yamm-content -->
            </li>
          </ul>
          </li>
		   <li class="dropdown yamm-fw <?php if($page_name=="favorites"){
							echo "active";
							}?>">
          <a href="<?php echo base_url('web/home/favorites/1')?>" class="dropdown-toggle" data-hover="dropdown">
		  <span class='skew_it'>Favorites</span>
          </a>
        </li>
        <li class="dropdown yamm-fw">
          <a href="<?php echo base_url('web/home/about_us')?>" class="dropdown-toggle" data-hover="dropdown">
		  <span class='skew_it'>About Us </span>
          </a>
        </li>
        <li class="resp_menu dropdown yamm-fw ">
          <a href="#" class="dropdown-toggle resp_menu" data-hover="dropdown" data-toggle="dropdown" >
		  <span class='skew_it'>Account</span>
          </a>
		   <ul class="dropdown-menu">
		     <div class="yamm-content">
			 <li><a href="<?php echo base_url('web/payment/order_history');?>">Change password</a>
			 </li>
			 <li><a href="<?php echo base_url('web/home/logout');?>">Logout</a>
			 </li>
			 </div>
		   </ul>
        </li>
        <li class="resp_menu dropdown yamm-fw ">
          <a href="<?php echo base_url('web/home/cart');?>" class="dropdown-toggle" data-hover="dropdown"><span class='skew_it'>Cart</span>
          </a>
        </li>
        </ul>
		
		<style>

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 130px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
	
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>
<body>


		
		
		
    </div>
    <div class="icons_set pull-right">
      <a  data-toggle="collapse" data-target="#search" > 
        <img src="<?php echo base_url();?>assets/svgs/lil me icons_search.svg">&nbsp*30
      </a>
	   <a href="<?php echo base_url('web/home/cart');?>" >
        <img src="<?php echo base_url();?>assets/svgs/lil me icons_cart.svg" >&nbsp*30
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
	
	  <?php $user_id =$this->session->userdata('user_id');//'';//
		$api_key =$this->session->userdata('api_key');//''; //
		if($user_id!=''){?>
	  
	  <ul style="display: inline-block;-webkit-padding-start: 0px;">
   
  <li class="dropdown" style="display: -webkit-box;">
    <a href="javascript:void(0)" class="dropbtn"><img src="<?php echo base_url();?>assets/svgs/profile.svg" style="height: 22px;"></a>
    <div class="dropdown-content">
      <a href="<?php echo base_url('web/payment/order_history');?>">My Orders</a>
      <a href="#">Change Password</a>
      <a href="<?php echo base_url('web/home/logout');?>">Logout</a>
     
    </div>
  </li>
</ul>
		<?php }else{ ?>
      
	  <a class="fancybox fancybox.iframe" href="<?php echo base_url('web/signup/login');?>" ><img src="<?php echo base_url();?>assets/svgs/profile.svg" style="height: 22px;"></a>
		<?php } ?>
	
    </div>
	 <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search" action="<?php echo base_url('web/home/search')?>">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name='input'>
                        <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"style="background-color:#EF6ACA;"><i class="fa fa-search">
			<i class="fa fa-sign-out"></i></i>
			</button>

		    </span>
                    </div>
                </form>

            </div>
    </div>
  </div>


<div style="min-height: 70px;"></div>
					