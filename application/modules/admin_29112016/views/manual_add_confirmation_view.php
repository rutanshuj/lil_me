 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manual Add
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manual Add</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/on_memo_status');?>" class="btn btn-primary" > On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_history');?>" class="btn btn-primary" > Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/manual_add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manual Add</a></div>
				</div>
		  
		  
		  
		  
		  
		   <div class="col-xs-6">
			<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Confirmation</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				
				<form method="post" action="<?php echo base_url('admin/out_on_memo/manual_add_confirmation');?>" onsubmit="return validateForm()"  name="step_third" id="step_third">
				
               
			
				
                  <div class="box-body">
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  <?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="margin_left_right_12 alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php } else if(isset($success)){ ?>		
				
		<div class="margin_left_right_12 alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
                    <div class="form-group">
					 <label for="inputEmail3" class="col-sm-2 control-label"  style="width: 30% !important;">Selected User</label>
                     
                      
					 <?php if(isset($selected_user)){echo ucfirst($selected_user);}?>
                      
                      
                    </div>
                 
                 
				 
				 <div class="form-group">
					 <label for="inputEmail3" class="col-sm-2 control-label"  style="width: 30% !important;">Product Selected:</label>
                     
                      
					  <?php if(is_array($out_on_memo_product_id)){echo count($out_on_memo_product_id);}?>
                      
                      
                    </div>
				 
				 
				
				 
				  <div class="form-group">
					 <label for="inputEmail3" class="col-sm-2 control-label"  style="width: 30% !important;">Memo Date:</label>
                     
                      
					 <?php if(isset($memo_date)){echo $memo_date;}?>
                      
                      
                    </div>
				 
				  <div class="form-group">
					 <label for="inputEmail3" class="col-sm-2 control-label"  style="width: 30% !important;">Expiry Date:</label>
                     
                      
					 <?php if(isset($expiry_date)){echo $expiry_date;}?>
                      
                      
                    </div>
				 
				 
				 
				 
				 
				 
				 
                  </div><!-- /.box-body -->
                  <div class="box-footer">
				  
				  
				  <a href="<?php echo base_url('admin/out_on_memo/manual_add_make_memo');?>" 
     class="btn btn-primary">Back</a>
				  
				  <input type="submit" class="btn btn-primary pull-right" id="submit" name="submit" value="Submit">
		
                   
                  
                  </div><!-- /.box-footer -->
                </form>
              </div>
			</div>	
			
			
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
            <div class="col-xs-6">
             

            
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   