 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sub-Category
            <small>Add</small>
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
					<a href="<?php echo base_url('admin/sub_category');?>" class="btn btn-primary" > List</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/category/add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Add</a></div>
					
					
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add Sub-Category</h3>
                </div>
                <div class="box-body">
				
			 
		
			
              <div class="col-xs-12">
			  
			  <form role="form" action="<?php echo base_url('admin/sub_category/add');?>" method="post"  enctype="multipart/form-data">
			
			
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
				
				
				<div  style="float: left;width: 160px;">Sub-Category Name :</div>
				<div>
				<input value="<?php if(isset($sub_category_name)){echo $sub_category_name ;}?>" name="sub_category_name" id="sub_category_name">
				</div>
				
				
                </div>
				<div class="form-group">
				
				
				<div  style="float: left;width: 160px;">Sort Order :</div>
				<div class="input-group">
				
               
				<input type="number" value="<?php if(isset($sort_order)){echo $sort_order ;}?>" name="sort_order" type="number"  min="0" required>
				
				
				</div>
				
				
                </div>
				 <div class="form-group">
				<div  style="float: left;width: 160px;">Category Name :</div>
				<div>
				
				
				<select class="form-control" name="category_id" id= "category_id"  style="width: inherit;">
				
				<?php if(count($category_list)!="0"){
						$i=0;
						foreach($category_list as $category_rows){
							
				?>		
				
				
                        <option value="<?php echo $category_rows->category_id;?>"><?php echo $category_rows->category_name;?></option>
                       
                    
				<?php
				
						}
				}
				?>
				  </select>
				
				
			
				</div>
				
				
                </div>
				
                
				
							
             
				
				
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Add Sub-Category" >
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
	  
	  
   