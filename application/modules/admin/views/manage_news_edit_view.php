 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Market News
            <small>edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Market News</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
		 
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/market_news/');?>" class="btn btn-primary" > Push Notification</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/market_news/add');?>" class="btn btn-primary"> Add News</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/market_news/manage_news');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manage News</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Edit News</h3>
                </div>
                <div class="box-body">
				
			 
		
			
              <div class="col-xs-12">
			  
			  <form role="form" action="<?php echo base_url('admin/market_news/edit?id=').$news_id;?>" method="post"  enctype="multipart/form-data">
			
			
			
			
			
				
		<?php if(isset($error)){ ?>
		
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error:: </h4>
                <?php echo validation_errors();?>
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
				<div  style="float: left;width: 160px;">Headline :</div>
				<div>
				<input type="textbox" name="headline" id="headline" value="<?php if($headline){echo $headline;}?>">
				</div>
				
				
                </div>
				
				
				
                <div class="form-group">
				<div style="float: left;width: 160px;">News Detail :</div>
				<div><textarea rows="4" cols="50"  name="news_detail" id="news_detail"><?php if($news_detail){echo $news_detail;}?></textarea></div>
				
				
			   </div>
				
							
             
				
				<div class="form-group">
				
				<div style="float: left;width: 160px;">Select News Category :</div>
				
				
				
				<div>
				
				<select name="news_category_id" id="news_category_id"  class="form-control" style="width: inherit;">
				<?php foreach($news_category as $news_category_row) {
					$selected="";
					if(isset($news_category_id) && ($news_category_id==$news_category_row->news_category_id)){
						$selected ='selected';
					}
					?>
					<option value="<?php echo $news_category_row->news_category_id;?>" <?php echo $selected;?>><?php echo $news_category_row->news_category;?></option>
				<?php
				}
				?>
				</select>
				</div>
				
				
                </div>
				<div class="form-group">
				
				
				<div  style="float: left;width: 160px;">News Priority :</div>
				<div class="input-group">
				
				
				
				<?php foreach($news_priority_m as $news_priority_row) {
					$selected="";
					if(isset($news_priority) && ($news_priority==$news_priority_row->news_priority_position)){
						$selected =' checked="checked"';
					}
					?>
					 <span style="padding-right: 10px;"><input type="radio" name="news_priority" id="news_priority" value="<?php echo $news_priority_row->news_priority_position;?>"  <?php echo $selected;?>><?php echo $news_priority_row->news_priority_title;?> </span>
					 
					
				<?php
				}
				?>
				<?php 
				/* ?>
                <span style="padding-right: 10px;"><input type="radio" name="news_priority" id="news_priority" value="1"  >High </span>
				<span style="padding-right: 10px;"><input type="radio" name="news_priority" id="news_priority" value="2"  >Medium</span>
				<span style="padding-right: 10px;"><input type="radio" name="news_priority" id="news_priority" value="3"  >Low</span>
				<?php */
				?>
				
				
				</div>
				
				
                </div>
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">Add Image :</div>
				<div><input type="file" id="userfile" name="userfile" ></div>
				
				
                </div>
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Update News" >
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
	  
	  
   