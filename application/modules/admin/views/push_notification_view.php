 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Market News
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Market_news</li>
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
					<a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Push Notification</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/market_news/add');?>" class="btn btn-primary"" class="btn btn-primary"> Add News</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/market_news/manage_news');?>" class="btn btn-primary"> Manage News</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Push Notification</h3>
                </div>
                <div class="box-body">
				
				
		
			
              <div class="col-xs-12">
			  
			  <form role="form" action="<?php echo base_url('admin/market_news');?>" method="post"  enctype="multipart/form-data">
			
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
				<div  style="float: left;width: 160px;">Notification :</div>
				<div><textarea rows="4" cols="50" name="notification" id="notification"></textarea></div>
				
				
                </div>
				
				
			
				
							
             
				
				<div class="form-group">
				
				<div style="float: left;width: 160px;">Select User Type : :</div>
				
				
				
				<div>
				
				<select name="user_type_id" id="user_type_id"  class="form-control" style="width: inherit;">
				<option value="All" >All</option>
				<?php foreach($user_type as $user_type_row) {?>
					<option value="<?php echo $user_type_row->user_type_id;?>"><?php echo $user_type_row->user_type;?></option>
				<?php
				}
				?>
				</select>
				</div>
				
				
                </div>
				
				
				
				
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Push Notification" >
				</div>
				
				
				
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
	  
	  
   