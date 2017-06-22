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
					<a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" id="upload_excel_page">Upload Excel</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_download_excel');?>" class="btn btn-primary"" class="btn btn-primary" id="download_excel_page"> Download Excel</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_bulk_image_upload');?>" class="btn btn-primary" id="bulk_image_upload_page"> Bulk Image Upload</a></div>
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/bulk_certificate_image_upload');?>" class="btn btn-primary" id="bulk_certificate_image_upload_page"> Bulk Certificate Image Upload</a></div>
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
		
		
		<script src="<?php echo base_url()."assets/ajax/libs/jquery/1.12.2/jquery.min.js";?>"></script>
		
		
		
			<script>
			
$(document).ready(function(){
	document.getElementById("uploading").style = "visibility: hidden";
	$("#verify_direct").hide();
	 $("#frm_verify_direct").hide();
		 $("#fileinfo").show();
    $("#radio_upload").click(function(){
         $("#verify_direct").hide();
		 $("#direct").show();
		 
		 $("#frm_verify_direct").hide();
		 $("#fileinfo").show();
		 
		 
    });
    $("#radio_upload_direct").click(function(){
       
		 $("#direct").hide();
		$("#verify_direct").show();
		
		
		
		$("#frm_verify_direct").show();
		 $("#fileinfo").hide();
    });
});
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





document.getElementById('upload_excel_page').style.pointerEvents = 'none';
document.getElementById('download_excel_page').style.pointerEvents = 'none';
document.getElementById('bulk_image_upload_page').style.pointerEvents = 'none';
document.getElementById('bulk_certificate_image_upload_page').style.pointerEvents = 'none';

}
function hideLoading(){
document.getElementById("loading").style = "visibility: hidden";
document.getElementById("uploading").style = "visibility: hidden";
}
function submitForm() {
           
            var fd = new FormData(document.getElementById("fileinfo"));
           
			showLoading();
            $.ajax({
              url: "<?php echo base_url('admin/diamond_excel_uploader/diamond_excel_upload');?>",
              type: "POST",
              data: fd,
              processData: false, 
              contentType: false   
            }).done(function( data ) {
				
				window.location = "<?php echo base_url('admin/diamond_excel_uploader');?>";
            });
            return false;
        }
function submitForm1(name){
		 
           
		   showLoading();
		   $.ajax({
							
				type: "POST",
				url: "<?php echo base_url('admin/diamond_excel_uploader/diamond_excel_upload');?>",
				data: {                
								'file_full_path' : name,
								'user_type' : name
							},
				
				
            }).done(function( data ) {
				
				window.location = "<?php echo base_url('admin/diamond_excel_uploader');?>";
            });			
        }
</script>
			
			
			<div class="form-group">
			
			
			<?php 	if(isset($table)&&(!empty($table))){?>
					<div class="col-xs-6">
				<form method="post" id="fileinfo1" name="fileinfo1" >
            <div style="float:left" ><input value="Upload"  type="button"  class="btn btn-primary" onClick="return submitForm1(document.getElementById('file_full_path').value)" /></div>
			
			<input type="hidden" id="file_full_path" name="file_full_path" value="<?php if(isset($file_full_path)){echo $file_full_path;}?>">
			
			<a href="<?php echo base_url('admin/diamond_excel_uploader');?>"  class="btn btn-primary" >Back</a>			
     
			</form>				
				</div>				
				
				<?php 
			} else {
			?>
			<div class="col-xs-6">
			<div><input id="radio_upload" type="radio" name="u_load" checked>Direct Upload</div>
			
			<div><input id="radio_upload_direct" type="radio" name="u_load" >Verify and Upload</div>
			<div id="direct">		
			
			
			<!--	<form id="frm_direct" action="<?php echo base_url().('admin/diamond_excel_uploader/diamond_excel_upload');?>" method="POST" enctype="multipart/form-data" > -->
			
			<form id="fileinfo" name="fileinfo" onsubmit="return submitForm();" >
            
    
     <b>Select File To Upload:</b><br />
			<div style="float:left;"><input type="file" name="userfile" accept= "application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required/></div>
			<div><input type="submit" name="submit" value="Upload" class="btn btn-primary" /></div>
			
			
        
			
			
			</form>
			
			</div>
			
			<div id="verify_direct">
		<form  id="frm_verify_direct" action="<?php echo base_url().('admin/diamond_excel_uploader/excel_verify_upload');?>" method="POST" enctype="multipart/form-data" >          
            	<b>Select File To Upload:</b><br />
			<div style="float:left;"><input type="file" name="userfile" accept= "application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/></div>
			<div><input type="submit" name="submit" value="Upload" class="btn btn-primary" /></div>
			</form>		
			
			</div>
			</div>
			
			
			<?php 
			}
			?>
			
			<div class="col-xs-6"><label id="uploading">Please wait data is uploading....</label><img id='loading' src='<?php echo base_url().'assets/ajax/Triangles indicator.gif';?>' style='visibility: hidden;'></div>
			
						
				
						
               </div>
			 
<?php 	if(isset($table)&&(!empty($table))){?>

<div style="overflow: scroll;overflow-y:hidden" class="col-xs-12"	 ><?php echo $table;?></div>
<?php }?>
			  
			
				
				
				
				
				
             
              </div>
              <!-- /.box-body -->

          
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->