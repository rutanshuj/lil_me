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
            catalogue
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">catalogue</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;" >
					<a href="<?php echo base_url('admin/catalogue');?>" class="btn btn-primary" > Add</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/catalogue/update');?>" class="btn btn-primary" > Update</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a  style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" href="<?php echo base_url('admin/catalogue/bulk_upload');?>" class="btn btn-primary" > Bulk Upload</a></div>
					
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Category List</h3>
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
                <div class="box-body">
				<form id="catalogue" name="catalogue" method="post"  enctype="multipart/form-data">
				 <input type="file" name="userfile" id="userfile" accept="application/zip"><br>
  <input type="submit" value="Bulk Upload" name="upload" class="btn btn-primary">
				</form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   