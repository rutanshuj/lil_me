 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Upload Excel
         
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Upload Excel</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
		
		
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px">Upload Excel</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/jewellery_download_excel');?>" class="btn btn-primary"" class="btn btn-primary"> Download Excel</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/jewellery_bulk_image_upload');?>" class="btn btn-primary"> Bulk Image Upload</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Upload</h3>
                </div>
                <div class="box-body">
				
				
		
			
              <div class="col-xs-12">
			  
		<?php if(isset($success)){ ?>
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		<?php 
		}
		?>
		
		<?php if(isset($error)){ ?>	
		
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo $error;?>
              </div>		
		<?php 
		}
		?>
		
		
			
			
			
			<div class="form-group">
			
			
			
			<form action="<?php echo base_url().('admin/excel_uploader/excel_upload');?>" method="POST" enctype="multipart/form-data" >
            Select File To Upload:<br />
			<div style="float:left;"><input type="file" name="userfile" accept= "application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/></div>
			<div><input type="submit" name="submit" value="Upload" class="btn btn-primary" /></div>
            
            
            
    
      </form>
			
			
				
						
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