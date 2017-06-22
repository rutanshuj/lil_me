  <style >
 .account_view{
 width: 400px ;
    margin: 1% auto;
 }
 </style>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Account settings
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url('admin/admin_account_settings');?>">account view</a></li>            
			<li class="active">change password</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
	
		
		
          <div class="row">
            <div class="register-box account_view">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Change Password </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
			 
		
			
              <div class="register-box-body">
			  
			  <form role="form" action="<?php echo base_url('admin/admin_account_settings/password_modify/');?>" method="post">
			
			
				<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php 
		}
		?>
		<?php if(isset($success)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
			
			
                <div class="form-group">
                  <label for="firstname">Enter Your Current Password*</label>
                  <input type="password" class="form-control" id="oldpassword" name="oldpassword" autocomplete="off" required>
                </div>
				
                <div class="form-group">
                  <label for="lastname">Enter New Password*</label>
                  <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                </div>
				
							
               <div class="form-group">
                  <label for="username">Retype Password* </label>
                  <input type="password" class="form-control" id="repassword" name="repassword" autocomplete="off" required>
                </div>
				
				
				<div class="form-group" style="border-color: #00acd6;float:right;" >
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Change Password" >
				
				
                  
                </div>
				<div class="form-group"  style="border-color: #00acd6;">
				<a href="<?php echo base_url('admin/admin_account_settings');?>" class="btn btn-info">Cancel</a>
                  
                </div>
				
				
				</form>
				
				
				
				
				
             
              </div>
              <!-- /.box-body -->

          
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   