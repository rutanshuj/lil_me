 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mood Images
            <small> Bulk Image Upload</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mood</li>
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
         
			
			
			var is_mobile =$('input[name="is_mobile"]:checked').val();
			
           
			showLoading();
			
            $.ajax({
              url: "<?php echo base_url('admin/mood/zip_upload?is_mobile=');?>"+is_mobile,
              type: "POST",
              data: fd,
              processData: false, 
              contentType: false   
            }).done(function( data ) {
				
				
				window.location = "<?php echo base_url('admin/mood/bulk_image_upload');?>";
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
		//document.getElementById('sub_category_page').style.pointerEvents = 'none';
		document.getElementById('product_page').style.pointerEvents = 'none';
		//document.getElementById('catalogue').style.pointerEvents = 'none';
		//document.getElementById('mood').style.pointerEvents = 'none';
		
		
		document.getElementById('request_for_quote_page').style.pointerEvents = 'none';
	
		
		
	
		
		

		
		
		
		//document.getElementById('jewellery_download_excel_page').style.pointerEvents = 'none';
		
		//document.getElementById('jewellery_bulk_image_upload_page').style.pointerEvents = 'none';
		//document.getElementById('upload_excel_page').style.pointerEvents = 'none';

		
}
		</script>
		
          <div class="row">
		 <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;" >
					<a href="<?php echo base_url('admin/mood');?>" class="btn btn-primary" > List</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/mood/mood_modify');?>" class="btn btn-primary" > Modify</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/mood/bulk_image_upload');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Bulk Image Upload</a></div>
					
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
				
				  
				
				<input type="radio" name="is_mobile" id="is_mobile" value="0" checked>Desktop 
				<input type="radio" name="is_mobile" id="is_mobile"  value="1">Mobile <br>
				
				
            Select File To Upload:<br />
			<div style="float:left;">
            <input type="file" name="userfile" accept="application/zip" required/>
            </div>
			<div>
            <input type="submit" name="submit" value="Upload" class="btn btn-primary" />
			</div>
        </form>
			
			
			
				
						
               </div>
			 
<div class="col-xs-6"><label id="uploading">Uploading images. Hold on to your coffee...</label><img id='loading' src='<?php echo base_url().'assets/ajax/Triangles indicator.gif';?>' style='visibility: hidden;'></div>
			  
			
				
				
				
				
				
				
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