 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Category
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">verify_admin</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		<?php if(isset($message)){ ?>
		<div class="alert alert-error __web-inspector-hide-shortcut__">
		<button class="close" data-dismiss="alert"></button><?php echo $message;?></div>
		<?php 
		}
		
		?>
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/on_memo_status');?>" class="btn btn-primary" > On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_history');?>" class="btn btn-primary" > Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manual Add</a></div>
				</div>
		  
            <div class="col-xs-6">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Confirmation</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

				<form method="post" action="<?php echo base_url('admin/diamond_out_on_memo/manual_add_confirmation');?>" onsubmit="return validateForm()"  name="step_third" id="step_third">
				<?php echo validation_errors(); ?>
					<div>
						<div>Selected User: <?php if(isset($selected_user)){echo $selected_user;}?></div>
						<div>Product Selected: <?php if(is_array($out_on_memo_product_id)){echo count($out_on_memo_product_id);}?></div>
						<div>Memo Date: <?php if(isset($memo_date)){echo $memo_date;}?></div>
						<div>Expiry Date: <?php if(isset($expiry_date)){echo $expiry_date;}?></div>
						
					</div>
					
					<div>				
						<div style="float:left;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add_make_memo');?>" class="btn btn-primary">Back</a></div>
						<div> <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit"></div>
					</div>		
			 </form>
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   