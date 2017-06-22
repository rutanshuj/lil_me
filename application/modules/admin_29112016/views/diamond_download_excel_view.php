 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Download Excel
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Download Excel</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
		<?php if(isset($message)){ ?>
		<div class="alert alert-error __web-inspector-hide-shortcut__">
		<button class="close" data-dismiss="alert"></button><?php echo $message;?></div>
		<?php 
		} else if(isset($successful)){ 
		?>
		<div class="alert alert-error __web-inspector-hide-shortcut__">
		<button class="close" data-dismiss="alert"></button><?php echo $successful;?></div>
		<?php
		
		}
		
		
		?>
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_excel_uploader');?>" class="btn btn-primary" >Upload Excel</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_download_excel');?>" class="btn btn-primary"" class="btn btn-primary"style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Download Excel</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_bulk_image_upload');?>" class="btn btn-primary"> Bulk Image Upload</a></div>
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/bulk_certificate_image_upload');?>" class="btn btn-primary"> Bulk Certificate Image Upload</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Download Excel</h3>
                </div>
                <div class="box-body">
				
				
		
			
              <div class="col-xs-12">
			  
		
			
			
			
			<div class="form-group">
			
			
			<a class="btn btn-primary"  href="<?php echo base_url().('admin/diamond_download_excel/download_excel');?>"><i class="fa fa-download"></i> Download Excel</a>
			
			
			
				
						
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