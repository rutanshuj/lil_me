  <style  >
 margin_left{ 
	margin-left: 10px;
	color: #fff;
	font-size: 14px;
 }
 sub_header{
     margin-left: 20px !important;
 }

</style>
  
	  <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
		<?php 
          /* <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div> */
        ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
           
			
			<li class="header margin_left" style="color: #fff;font-size: 14px;">Dashboard</li>
		
		
		<li style="margin-left: 20px !important;" <?php  if($page=="home_page"){ echo 'class="active"';} ?>	>
              <a href="<?php echo base_url('admin/dashboard');?>" id="dashboard_page">
                <i class="fa fa-calendar"></i> <span>Home Page</span>
                
              </a>
            </li>
			<?php
			if(($this->session->userdata('username')=="admin") ||($this->session->userdata('username')=="Admin") ) {
		?><li style="margin-left: 20px !important;"	<?php  if($page=="verify_admin"){ echo 'class="active"';} ?>	>
              <a href="<?php echo base_url('admin/verify_admin');?>" id="verify_admin_page">
                <i class="fa fa-calendar"></i> <span>Verify Admin</span>
                
              </a>
            </li>
			<?php 
		} else {
		?>
		<input type="hidden" name="verify_admin_page" id="verify_admin_page">
		
			<?php
		}?>
			
		
			<li style="margin-left: 20px !important;" <?php  if($page=="verify_user"){ echo 'class="active"';} ?>		>
              <a href="<?php echo base_url('admin/verify_user');?>" id="verify_user_page">
                <i class="fa fa-calendar"></i> <span>Verify Users</span>
                
              </a>
            </li>
		
			<li style="margin-left: 20px !important;"	<?php  if($page=="market_news"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/market_news');?>" id="market_news_page">
                <i class="fa fa-calendar"></i> <span>Market News</span>
                
              </a>
            </li>
			
			
				<li style="margin-left: 20px !important;"	<?php  if($page=="admin_account_settings"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/admin_account_settings');?>" id="admin_account_settings_page">
                <i class="fa fa-calendar"></i> <span>Account Settings</span>
                
              </a>
            </li>
		<li class="header" style="color: #fff;font-size: 14px;">Manage Resources</li>
		
			<li style="margin-left: 20px !important;"	<?php  if($page=="excel_uploader"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/excel_uploader');?>"  id="excel_uploader_page">
                <i class="fa fa-calendar"></i> <span>Upload Excel</span>
                
              </a>
            </li>
		
			<li style="margin-left: 20px !important;"	<?php  if($page=="stock"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/stock');?>"  id="stock_page">
                <i class="fa fa-calendar"></i> <span>Stock</span>
                
              </a>
            </li>
		
			<li style="margin-left: 20px !important;"	<?php  if($page=="attribute"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/attribute');?>" id="attribute_page">
                <i class="fa fa-calendar"></i> <span>Attributes</span>
                
              </a>
            </li>
		
			<li style="margin-left: 20px !important;"	<?php  if($page=="category"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/category');?>"  id="category_page">
                <i class="fa fa-calendar"></i> <span>Category</span>
                
              </a>
            </li>
		<!--
			<li style="margin-left: 20px !important;"	<?php  if($page=="sub_category"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/sub_category');?>"  id="sub_category_page">
                <i class="fa fa-calendar"></i> <span>Sub-Category</span>
                
              </a>
            </li>
		-->
			<li style="margin-left: 20px !important;"	<?php  if($page=="product"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/product');?>"   id="product_page">
                <i class="fa fa-calendar"></i> <span>Products</span>
                
              </a>
            </li>
			<!--
			<li style="margin-left: 20px !important;"	<?php  if($page=="catalogue"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/catalogue');?>"   id="catalogue">
                <i class="fa fa-calendar"></i> <span>Catalogue</span>
                
              </a>
            </li>
		-->
			<li style="margin-left: 20px !important;"	<?php  if($page=="mood"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/mood');?>" id="mood">
                <i class="fa fa-calendar"></i> <span>Home Page Images</span>
                
              </a>
            </li>	
		<li style="margin-left: 20px !important;"	<?php  if($page=="request_for_quote"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/request_for_quote');?>"  id="diamond_request_for_quote_page">
                <i class="fa fa-calendar"></i> <span>Request For Quote</span>
                
              </a>
            </li>
			<li style="margin-left: 20px !important;"	<?php  if($page=="sales"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/sales/order_placed');?>" id="request_for_quote_page">
                <i class="fa fa-calendar"></i> <span>Sales</span>
                
              </a>
            </li>
			
			<?php
		
           /*
			<li style="margin-left: 20px !important;"	<?php  if($page=="out_on_memo"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/out_on_memo');?>" id="out_on_memo_page">
                <i class="fa fa-calendar"></i> <span>Out On Memo</span>
                
              </a>
            </li>
		
		<li class="header" style="color: #fff;font-size: 14px;">Diamond</li>
		
				
			<li style="margin-left: 20px !important;"	<?php  if($page=="diamond_excel_uploader"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/diamond_excel_uploader');?>" id="diamond_excel_uploader_page">
                <i class="fa fa-calendar"></i> <span>Upload Excel</span>
                
              </a>
            </li>
					
			<li style="margin-left: 20px !important;"	<?php  if($page=="diamond_manage_stock"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/diamond_manage_stock');?>" id="diamond_manage_stock_page">
                <i class="fa fa-calendar"></i> <span>Manage Stock</span>
                
              </a>
            </li>
					
			<li style="margin-left: 20px !important;"	<?php  if($page=="diamond_attribute"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/diamond_attribute');?>" id="diamond_attribute_page">
                <i class="fa fa-calendar"></i> <span>Attributes</span>
                
              </a>
            </li>
					
			<li style="margin-left: 20px !important;"	<?php  if($page=="product_diamond"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/product_diamond');?>" id="product_diamond_page">
                <i class="fa fa-calendar"></i> <span>Manual Add</span>
                
              </a>
            </li>
				<li style="margin-left: 20px !important;"	<?php  if($page=="diamond_request_for_quote"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/diamond_request_for_quote');?>"  id="diamond_request_for_quote_page">
                <i class="fa fa-calendar"></i> <span>Request For Quote</span>
                
              </a>
            </li>	
			<li style="margin-left: 20px !important;"	<?php  if($page=="diamond_out_on_memo"){ echo 'class="active"';} ?>>
              <a href="<?php echo base_url('admin/diamond_out_on_memo');?>" id="diamond_out_on_memo_page">
                <i class="fa fa-calendar"></i> <span>Out On Memo</span>
                
              </a>
            </li>
		
		
		
		  <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
			
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        */   
		  ?>
		  </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

     