<div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a>
                        </li>
                        <li>My wishlist</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Customer section</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="<?php echo base_url('web/payment/order_history')?>"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('web/home/wishlist')?>"><i class="fa fa-heart"></i> My wishlist</a>
                                </li>
                                <li>
                                    <a href="customer-account.html"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('web/home/logout')?>"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9" id="wishlist">

                   

                    <div class="box">
                        <h1>My wishlist</h1>
                        <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    </div>

                        <?php 
				$image_url='';
				if(is_array($favorites)&&(count($favorites)!="0")) {
				foreach($favorites as $product_row){
				
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
                                <div class="text" style=" height: 230px;">
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
                                    <a class="btn btn-default" onclick="add_to_cart(this)" product_id="<?php echo $product_row->product_id?>" cart_flag="<?php echo $product_row->in_cart?>" 
									cart_id=<?php if ($product_row->in_cart==1)
									{echo $product_row->cart_id;}else{
										
									} ?>
										><i class="fa fa-shopping-cart" style="color: #1E0022;"></i>
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
                           
                        <!-- /.col-md-4 -->

                       

                       
                    </div>
                    <!-- /.products -->
				<div class="pages">

                        <p class="loadMore phone-controls ">
                            <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down" style="color: #1E0022;"></i> Load more</a>
                        </p>

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
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        