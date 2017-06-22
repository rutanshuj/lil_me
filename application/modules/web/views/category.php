 <style>
 .col-xs-6 {
    padding-right: 5px;
	padding-left: 5px;
}
  #filter_btn
  {
	   display:none
  }
  @media (min-width: 768px) {
  #fliter_div{
	  display:block !important
  }
  }
 
  .top-banner
  {
	   display:none
  }
@media (max-width: 768px) {
  #fliter_div{
	  display:none
  }
  #filter_btn
  {
	  margin-top:10px;
	   display:block
  }
   .info-bar
  {
	  padding:0px
  }
  
}
 </style>
 <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li><?php if(isset($subcategory_name))echo $subcategory_name->subcategory_name;?></li>
                    </ul>
					  <div class="box phone-controls">
                        <h1 style="color: #1E0022;"><?php if(isset($subcategory_name))echo $subcategory_name->subcategory_name;?></h1>
                        
                    </div>
                </div>
  
                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
 
 <button id="filter_btn" type="button" class="btn btn-default" style="margin-bottom:10px;width:100%;color: white;background-color: #1E0022;line-height: 32px;" data-toggle="dropdown"><span>Filter and Sort</span></button>
		  		
		<div id='fliter_div'>
					
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <?php $this->load->view('filter');?>
                    

                    

                   
					<div class="panel panel-default sidebar-menu phone-controls">
						  
                                        <div class="panel-heading">
										<h3 class="panel-title">Sort-by</h3>
										</div>
										  <div class="panel-body">
                                                <select name="sort-by" class="form-control">
                                                    <option>Price</option>
                                                    <option>Name</option>
                                                    <option>Sales first</option>
                                                </select>
										 </div>
                         
						</div>
					</div>
                    <!-- *** MENUS AND FILTERS END *** -->
					<div class="box info-bar phone-controls">
					<?php
						$start_page=1;
						$end_page=$page_no*6;
						if($end_page> $num_links) $end_page=$num_links;
						//echo $start_page." ".$end_page;?>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong><?php echo $start_page."-".$end_page; ?></strong> of <strong><?php echo $num_links; ?></strong> products
                            </div>

                           
                        </div>  
                    </div>	
                    <div class="banner website-controls">
                        <a href="#">
                            <img src="<?php echo base_url();?>assets/img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="box website-controls">
                        <h1 style="color: #1E0022;"><?php if(isset($subcategory_name))echo $subcategory_name->subcategory_name;?></h1>
                        </div>

                    <div class="box info-bar website-controls">
                        <div class="row">
						<?php
						$load_more=0;
						$start_page=($page_no-1)*6;
						if($start_page==0)$start_page=1;
						$end_page=$page_no*6;
						if($end_page > $num_links) {
							$load_more=1;
							$end_page=$num_links;
						}
						// echo $start_page." ".$end_page;?>
                            <div class="col-sm-12 col-md-4 products-showing ">
                                Showing <strong><?php echo $start_page."-".$end_page;?></strong> of <strong><?php echo $num_links; ?></strong> products
                            </div>
  
                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                       
                                        <div class="col-md-6 col-sm-6 website-controls pull-right">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control" onchange='abc(this.value);'>
													<option value='4'> Price Low to High</option>
													<option value='1'>Price High to Low</option>
                                                    <option value='2'>Name</option>
                                                    <option value='3'>Discount</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="row products">
				<?php 
				$image_url='';
				if(is_array($product_list['products'])&&(count($product_list['products'])!="0")) {
				foreach($product_list['products'] as $product_row){
				
				$file_headers = @get_headers($image_url);
				if(trim($product_row->image_url)!='') {
				$image_url=base_url().$product_row->image_url;
				} 
				else{ 
				$image_url = base_url().'assets/img/LPF-Loader-image.jpg';  
				}			?>
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>">
                                                <img src="<?php echo $image_url;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>">
                                                <img src="<?php echo $image_url;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>" class="invisible">
                                    <img src="<?php echo $image_url;?>" alt="" class="img-responsive">
                                </a>
                                <div class="text" style=" height: 208px;">
                                    <h3><a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>"><?php echo $product_row->product_name?></a></h3>
                                    <p class="price">
									<?php if($product_row->new_price==''){?>&#8377;<?php echo $product_row->mrp;}
									else{
									$new_price=money_format('%!i',$product_row->new_price);?>
									
									<del>&#8377;<?php echo $product_row->mrp;?></del>
									&#8377;<?php echo $new_price;}?>
									</p>
                                    <p class="buttons">
                                    <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>" class="btn btn-default website-controls">View detail</a>
                                    <a class="btn btn-default <?php if ($product_row->in_cart==1) echo 'added'; ?>" onclick="add_to_cart(this)" product_id="<?php echo $product_row->product_id?>" cart_flag="<?php echo $product_row->in_cart?>" 
									cart_id=<?php if ($product_row->in_cart==1)
									{echo $product_row->cart_id;}else{
										
									} ?>><i class="fa fa-shopping-cart <?php if ($product_row->in_cart==1) echo 'added'; ?>"></i>
										<?php if ($product_row->in_cart==0)
									{echo "Add to Cart";}else{
										
									echo "Remove";} ?></a>
                                    </p>
                                </div>
								<?php if($product_row->is_for_sale == 1){ ?>
                                <div class="ribbon sale">
                                    <div class="theribbon">SALE</div>
                                    <div class="ribbon-background"></div>
                                </div>
								<?php } ?>
								<?php if($product_row->is_new == 1){ ?>
                                <div class="ribbon new">
                                    <div class="theribbon">NEW</div>
                                    <div class="ribbon-background"></div>
                                </div>
								<?php } ?>
								<?php if($product_row->is_hot == 1){ ?>
                                <div class="ribbon gift">
                                    <div class="theribbon">HOT</div>
                                    <div class="ribbon-background"></div>
                                </div>
								<?php } ?>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
						<?php
						 }
						}
						?>
                                               
                    </div>  
                    <!-- /.products -->

                    <div class="pages">
						<?php if(!$load_more){?>
                        <p class="loadMore phone-controls ">
						
                            <a href="#" class="btn btn-primary btn-lg" onclick="insertParam('pn',<?php echo $page_no+1;?>)"><i class="fa fa-chevron-down" style="color: #1E0022;"></i> Load more</a>
                        </p>
						<?php }?>
                        <ul class="pagination website-controls">
						<?php if($links !=1){?>
						<li><a onclick="insertParam('pn',1)">&laquo;</a>
                            </li>
						<?php }?>
						<?php for($i=1;$i<=$links;$i++){?>
                            
                            <li><a onclick="insertParam('pn',<?php echo $i;?>)"><?php echo $i;?></a>
                            </li>
                            
						<?php }?>
						
                           
						<?php if($links !=1){?>
						<li><a  onclick="insertParam('pn',<?php echo $links;?>)">&raquo;</a>
                            </li>
						<?php }?>
                        </ul>
                    </div>
					<div class="banner phone-controls">
                        <a href="#">
                            <img src="<?php echo base_url();?>assets/img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>

                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container --> 
        </div>
<script>
$(document).ready(function(){
    $("#filter_btn").click(function(){
       $("#fliter_div").slideToggle();
		 /* if ($('#fliter_div').is(':visible')) {
			$("#fliter_div").toggleClass("");
		} else {
			$("#fliter_div").toggleClass("");
		} */
    });



});
function abc(value)
{
	insertParam('sortflag',value);
}

</script>