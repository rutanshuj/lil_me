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
            Sub-Category
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sub-Category</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
	
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;" >
					<a href="<?php echo base_url('admin/sub_category');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> List</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/sub_category/add');?>" class="btn btn-primary" > Add</a></div>
					
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Sub Category List</h3>
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
		}?>
                <div class="box-body">
				
				<?php if(count($sub_category)!="0"){
					?>
                  <table id="example16" class="table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
                      <!--  <th class="no-sort">Sl</th> -->
                        <th  class="width_20_persent ">Sub Category name</th>
                        <th  class="width_20_persent ">Category name</th>
                       <th class="width_20_persent ">Sort Order</th>
                        <th class="no-sort width_20_persent"></th>
						<th class="no-sort width_20_persent"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($sub_category)!="0"){
						$i=0;
						foreach($sub_category as $sub_category_rows){
							$i++;
						?>
								
                      <tr>
                      <!--   <td><?php //echo $i;?>.</td> -->
                        <td  class="width_20_persent"><?php echo $sub_category_rows->subcategory_name;?></td>
                        <td  class="width_20_persent"><?php echo $sub_category_rows->category_name;?></td>
                        <td class="width_20_persent"><?php echo $sub_category_rows->sort_order;?></td>
                        <td  class="width_20_persent"><a href="<?php echo base_url('admin/sub_category/edit?id=').$sub_category_rows->subcategory_id;?>"class="btn btn-primary" style="min-width: 52px;">Edit</a></td>
						
						<td  class="width_20_persent">
						
						
						<input value="Delete"  type="button"  class="btn btn-primary" onClick="return sub_category_delete('<?php echo $sub_category_rows->subcategory_id;?>','<?php echo $sub_category_rows->subcategory_name;?>')" style="min-width: 52px;"/>
						
						
						
						<script>
					function sub_category_delete(sub_category_id,name){
					
					swal({   title: "Are you sure to delete below sub category?", 
					  text: name,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, delete it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/sub_category/sub_category_delete?id=');?>"+sub_category_id+"&subcategory_id="+name;							  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
				}
					</script>
						
						
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
	  
	  
   