 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
 <script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link REL="StyleSheet" TYPE="text/css" HREF="<?php echo base_url().'assets/dist/css/table.css';?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Market News
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Market News</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		<?php if(isset($error)){ ?>
		
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $error;?>
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
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/market_news/');?>" class="btn btn-primary" > Push Notification</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/market_news/add');?>" class="btn btn-primary"> Add News</a></div>
					<div style="padding-bottom: 10px;"><a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manage News</a></div>
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Manage News</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($market_news)!="0"){
					?>
					<script>
					function news_delete(news_id,headline){
					
					swal({   title: "Are you sure to delete below news ?", 
					  text: headline,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, delete it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/market_news/news_delete?id=');?>"+news_id+"&headline="+headline;	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
				}
					</script>
					
					
                  <table id="example16" class="table table-bordered table-striped">
                    <thead>
                      <tr  class="table_th_border">
                        <th class="width_20_persent">Headline</th>
                        <th class="width_20_persent">News Category</th>
                        <th class="width_20_persent">Priority</th>
                        <th class="width_20_persent">Updated Date</th>
                        <th class="no-sort width_10_persent" ></th>
						<th class="no-sort width_10_persent"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($market_news)!="0"){
						foreach($market_news as $active_rows){
						?>
								
                      <tr>
                        <td><?php echo $active_rows->headline;?></td>
                        <td><?php echo $active_rows->news_category_name;?></td>
                        <td><?php echo $active_rows->priority;?></td>
                        <td><?php echo $active_rows->updated_on;?></td>
                        <td><a class="btn btn-primary" href="<?php echo base_url('admin/market_news/edit?id=').$active_rows->news_id;?>" style="min-width: 52px;">Edit</a></td>
						
						
						<td>
						
						<input value="Delete"  type="button"  class="btn btn-primary" onClick="return news_delete('<?php echo $active_rows->news_id;?>','<?php echo $active_rows->headline;?>')" style="min-width: 52px;"/>
						
						
						
						</td>
						
						
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
                   
                  </table>
				<?php } else {
					
					
				}
				?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   