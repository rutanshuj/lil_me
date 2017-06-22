 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Bulk image upload
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Bulk image upload</li>
          </ol>
        </section>

    <script src="<?php echo base_url()."assets/ajax/libs/jquery/1.12.2/jquery.min.js";?>"></script>
         
		   <!-- Main content -->
        <section class="content">
		<script>
		$(document).ready(function(){
	document.getElementById("uploading").style = "visibility: hidden";	
  
});
		function submitForm() {
           
		   
		  
		  
            var fd = new FormData(document.getElementById("fileinfo"));
           
			showLoading();
			
            $.ajax({
              url: "<?php echo base_url('admin/jewellery_bulk_image_upload/zipupload_jewellery');?>",
              type: "POST",
              data: fd,
              processData: false, 
              contentType: false   
            }).done(function( data ) {
				
				window.location = "<?php echo base_url('admin/jewellery_bulk_image_upload');?>";
            });
            return false;
        }
		function showLoading(){
		
		document.getElementById("loading").style = "visibility: visible";
		document.getElementById("uploading").style = "visibility: visible";
		document.getElementById('dashboard_page').style.pointerEvents = 'none';
		document.getElementById('verify_admin_page').style.pointerEvents = 'none';
		document.getElementById('verify_user_page').style.pointerEvents = 'none';
		document.getElementById('market_news_page').style.pointerEvents = 'none';
		document.getElementById('admin_account_settings_page').style.pointerEvents = 'none';
		document.getElementById('excel_uploader_page').style.pointerEvents = 'none';
		document.getElementById('stock_page').style.pointerEvents = 'none';
		document.getElementById('attribute_page').style.pointerEvents = 'none';
		document.getElementById('category_page').style.pointerEvents = 'none';
		document.getElementById('sub_category_page').style.pointerEvents = 'none';
		document.getElementById('product_page').style.pointerEvents = 'none';
		document.getElementById('request_for_quote_page').style.pointerEvents = 'none';
		document.getElementById('out_on_memo_page').style.pointerEvents = 'none';
		document.getElementById('diamond_excel_uploader_page').style.pointerEvents = 'none';
		document.getElementById('diamond_manage_stock_page').style.pointerEvents = 'none';
		document.getElementById('diamond_attribute_page').style.pointerEvents = 'none';
		document.getElementById('product_diamond_page').style.pointerEvents = 'none';
		document.getElementById('diamond_request_for_quote_page').style.pointerEvents = 'none';
		document.getElementById('diamond_out_on_memo_page').style.pointerEvents = 'none';
		
		document.getElementById('jewellery_download_excel_page').style.pointerEvents = 'none';
		
		document.getElementById('jewellery_bulk_image_upload_page').style.pointerEvents = 'none';
		document.getElementById('upload_excel_page').style.pointerEvents = 'none';

		
}
		</script>
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/excel_uploader');?>" class="btn btn-primary"  id="upload_excel_page">Upload Excel</a></div>
					
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/jewellery_download_excel');?>" class="btn btn-primary"" class="btn btn-primary" id="jewellery_download_excel_page"> Download Excel</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/jewellery_bulk_image_upload');?>" class="btn btn-primary"style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" id="jewellery_bulk_image_upload_page"> Bulk Image Upload</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Upload Bulk Image</h3>
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
		}else if(isset($error)){ ?>	
		
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo $error;?>
              </div>		
		<?php 
		}
		?>
			
			
			<div class="form-group col-xs-6">
			
			
			    <form  id="fileinfo" name="fileinfo" method="POST" enctype="multipart/form-data" onsubmit="return submitForm();">
            Select File To Upload:<br />
			<div style="float:left;">
            <input type="file" name="userfile" required/>
            </div>
			<div>
            <input type="submit" name="submit" value="Upload" class="btn btn-primary" />
			</div>
        </form>
			
			
			
				
						
               </div>
			 
<div class="col-xs-6"><label id="uploading">Please wait images is uploading....</label><img id='loading' src='<?php echo base_url().'assets/ajax/Triangles indicator.gif';?>' style='visibility: hidden;'></div>
			  
			
				
				
				
				
				
				
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