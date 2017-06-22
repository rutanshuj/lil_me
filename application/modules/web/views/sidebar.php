<div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
 <button id="filter_btn" type="button" class="btn btn-primary" style="margin-bottom:10px;width:100%" data-toggle="dropdown"><span>Filter and Sort</span></button>
					<div id='fliter_div'>
					
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li>
                                    <a href="<?php echo base_url('web/home/categories')?>">Men <span class="badge pull-right">42</span></a>
                                    <ul>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">T-shirts</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Shirts</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Pants</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Accessories</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="active">
                                    <a href="<?php echo base_url('web/home/categories')?>">Ladies  <span class="badge pull-right">123</span></a>
                                    <ul>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">T-shirts</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Skirts</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Pants</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Accessories</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('web/home/categories')?>">Kids  <span class="badge pull-right">11</span></a>
                                    <ul>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">T-shirts</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Skirts</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Pants</a>
                                        </li>
                                        <li><a href="<?php echo base_url('web/home/categories')?>">Accessories</a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>

                        </div>
                    </div>

                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Prints <a class="btn btn-xs btn-danger pull-right" href="#"><i class="fa fa-times-circle"></i> Clear</a></h3>
                        </div>

                        <div class="panel-body">

                            <form>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">Circular
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">Flower 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">Owl print in white
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">White kari leaf print
                                        </label>
                                    </div>
                                </div>

                                <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>

                            </form>

                        </div>
                    </div>
					<div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Price <a class="btn btn-xs btn-danger pull-right" href="#"><i class="fa fa-times-circle"></i> Clear</a></h3>
                        </div>

                        <div class="panel-body">

                            <form>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">0-1,000
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">1,000-2,000
                                        </label>
                                    </div>
                                   
                                </div>

                                <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>

                            </form>

                        </div>
                    </div>

                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Colours <a class="btn btn-xs btn-danger pull-right" href="#"><i class="fa fa-times-circle"></i> Clear</a></h3>
                        </div>

                        <div class="panel-body">

                            <form>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> <span class="colour white"></span> White (14)
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> <span class="colour blue"></span> Blue (10)
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> <span class="colour green"></span> Green (20)
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> <span class="colour yellow"></span> Yellow (13)
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> <span class="colour red"></span> Red (10)
                                        </label>
                                    </div>
                                </div>

                                <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>

                            </form>

                        </div>
						
                    </div>
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

                    <div class="banner website-controls">
                        <a href="#">
                            <img src="<?php echo base_url();?>assets/img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>