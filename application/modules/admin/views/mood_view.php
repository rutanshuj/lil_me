 <!-- Content Wrapper. Contains page content -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
 <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
 <style>
 
 .margin_left_right_10{
	 margin-left: 12px;
    margin-right: 12px;
 }
 

 </style>
  <script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mood
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">mood</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;" >
					<a href="<?php echo base_url('admin/mood');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> List</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/mood/mood_modify');?>" class="btn btn-primary" > Modify</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/mood/bulk_image_upload');?>" class="btn btn-primary" > Bulk Image Upload</a></div>
					
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Mood List </h3> (Total <?php echo count($result);?> images found for the product)
                </div><!-- /.box-header -->
				<?php if(isset($success)){ ?>
		
		<div class="alert alert-success alert-dismissible margin_left_right_10">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		<?php 
		}
		?>
		
		<?php if(isset($error) &&($error!="")){ ?>
		<div class="alert alert-danger alert-dismissible margin_left_right_10">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php  echo $error;?>
              </div>
		<?php 
		}
		?>
		
		 <div class="row" style ="display: block;height: 500px;overflow-y: auto ;    margin-right: 0px  !important;
    margin-left: 0px  !important; ">
           
              <!-- small box -->
             
                 

				  
				  <?php 
				  
				
						if(!empty($result)){
						   foreach($result as $row){  
							$image=$row['image_thumbnail_url'];
						   if($row['image_thumbnail_url']==""){
							  $image= "assets/img/default.jpg";
						   }
						  ?>
						  <div class="col-lg-3 col-xs-6">
						  <div class="small-box">
                <div class="inner" style="text-align: center;color: #333 !important;">
						 <!-- <div class="col-md-2" style="margin-left: 10px;margin-bottom: 10px;">
						  
						 <div style="float: left;">-->
						
						  <img src="<?php echo  base_url().$image;?>" alt="Smiley face" width="170" height="200">
							<br>	 <b>  <?php if($row['is_mobile']=="0"){echo "Desktop";}else{echo "Mobile";}?></b>
						    </div>
				
				
               
             
              </div>  </div>
						  
						  <?php
						   }
						}
						  ?>
				  
				  

			  
          <!-- ./col -->
		
		
		
		</div>
		
		<div class="row">
		<!-- sd 
               <div class="row">
				  
				  <div class="col-sm-12" style ="display: block;height: 500px;overflow-y: auto ;">
				  				  
				<?php 				
						 /* if(!empty($result)){
						   foreach($result as $row){  
							$image=$row['image_thumbnail_url'];
						   if($row['image_thumbnail_url']==""){
							  $image= "assets/img/default.jpg";
						   }
						  ?>
						  <div class="col-md-3" style="padding-bottom: 15px;padding-top: 15px;">						  
						 <div style="margin-bottom: 2px;text-align: center;">						
						 <?php if($row['is_mobile']=="0"){echo "Desktop";}else{echo "Mobile";}?><br>
						  <img src="<?php echo  base_url().$image;?>" alt="Smiley face" width="170" height="200">
		
							</div> 														
						  </div>						  
						  <?php
						   }
						}  */
						  ?>							  
				 
				 
				  
				  <div class="col-sm-12">
				  
				  
				</div>
				
				</div>
              </div> --><!-- /.box -->
			  
			 
			  
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
		  
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   