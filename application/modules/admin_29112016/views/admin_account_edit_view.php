 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Account settings
            <small>edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Account settings</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
		
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Your Account Details </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
			 
		
			
              <div class="col-xs-6">
			  
			  <form role="form" action="<?php echo base_url('admin/admin_account_settings/edit');?>" method="post">
			  
			
              

<?php if(validation_errors()){ ?>
		
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo validation_errors();?>
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
                  <label for="firstname">First Name*</label>
                  <input type="input" class="form-control" id="firstname" value="<?php echo $firstname;?>" name="firstname" 
				  required>
                </div>
				
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="input" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname;?>">
                </div>
				
							
               <div class="form-group">
                  <label for="username">Username* </label>
                  <input type="input" class="form-control" id="username" name="username"   value="<?php echo $username;?>"
				  readonly>
                </div>
				
				<div class="form-group">
                  <label for="input">Email Id*</label>
                  <input type="email" class="form-control" id="email_id" name="email_id"  value="<?php echo $email_id;	?>"
				  required>
                </div>
				<div class="form-group">
                  <label for="primary_phone_number">Primary Phone Number*</label>
                  <input type="input" class="form-control" id="primary_phone_number" name="primary_phone_number"  value="<?php echo $primary_phone_number;	?>"	  required>
                </div>
				
				<div class="form-group">
                  <label for="secondary_phone_number">Secondary Phone Number</label>
                  <input type="input" class="form-control" id="secondary_phone_number" name="secondary_phone_number" value="<?php echo $secondary_phone_number;?>" >
                </div>
				
				
				<div class="form-group">
                  <label for="p_phone">Your City*</label>
                  
					 <select class="form-control"  name="city_id"  required>
				  
				  <?php  foreach($master_city as $row){
					  $selected ="";
					  if($row->id ==$city_id){
						 $selected ='selected="selected"';  
					  }
				  
				  
				  ?>
                    <option value="<?php echo $row->id;?>" <?php echo $selected;?>><?php echo $row->city_name;?></option>
				  <?php } ?>
                  </select>
				  
				  
                </div>
				
				<div class="form-group" style="border-color: #00acd6;float:right;" >
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Update Account Details" >
				
				
                  
                </div>
				<div class="form-group"  style=" border-color: #00acd6;">
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
	  
	  
   