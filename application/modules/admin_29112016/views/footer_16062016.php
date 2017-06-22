<?php if($page!="register"){ ?>
<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.0.0.1
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://lastlocal.in">Lastlocal</a>.</strong> All rights reserved.
      </footer>

        
  
    </div><!-- ./wrapper -->

	
<?php } ?>
	
	
	
	
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>  
    <!-- jQuery UI 1.11.4 -->
	
    <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
	
	
    <script src="<?php echo base_url();?>assets/dist/js/ui/1.11.4/jquery-ui.min.js"></script>
	
	
	
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	
	
 
	 
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>  
	<?php  //if($page!="verify_admin"){ ?>
    <!-- Morris.js charts -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
	
	
	<script src="<?php echo base_url();?>assets/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	
	
	
	
	
    <script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('');?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>-->
	
	<script src="<?php echo base_url();?>assets/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	
	
	
	
	
	
    <script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
	
    <!-- Bootstrap WYSIHTML5 -->
	
	
	
	<?php
	
	
	?>
	
	
	
	<?php
	
	if(isset($total_memo_request) &&($total_memo_request>0)){
		$i=0;
		foreach($memo_requests as $memo_requests_row){	
			
		$memo_request_date="";
							if(isset($memo_requests_row->memo_request_date)&&($memo_requests_row->memo_request_date!="")){
								$memo_request_date= date("Y-m-d", strtotime($memo_requests_row->memo_request_date));
							}
							/* 
							if(isset($memo_requests_rows->expiry_date)&&($memo_requests_rows->expiry_date!="")){
								$expiry_date= date("Y-m-d", strtotime($memo_requests_rows->expiry_date));
							} */
							
			
			$min_date = date("Y-m-d",strtotime("+1 day",  strtotime($memo_requests_row->memo_request_date)));
			$i++;	

			$currentdate= date("Y-m-d");
		?>
		<script>
		$('#memo_requests_date_<?php echo $i;?>').datepicker({
		 format: 'yyyy-mm-dd',
		 startDate: '<?php echo $currentdate;?>',
		 Default:'<?php echo $memo_request_date;?>',
      autoclose: true,
	  ignoreReadonly:true
	  
    });
		
		
		
		
		 $('#expiry_date_<?php echo $i;?>').datepicker({
		 format: 'yyyy-mm-dd',
		 startDate: '<?php echo $min_date;?>',
      autoclose: true,
	  ignoreReadonly:true
	  
    });
		</script>
		
		<?php		
	}
	} 
	?>
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	  
	<script>
      //Date picker
    $('#datepicker').datepicker({
		 format: 'yyyy-mm-dd',
      autoclose: true,
	  ignoreReadonly:true,
	  startDate: 'today'
	  
    });

$('#expiry_date').datepicker({
		  format: 'yyyy-mm-dd',
      autoclose: true,
	  
    });

     
    </script>
 
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
	<?php
	//}
	?>
    <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script> 
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script> 
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script> 
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<?php  if($page!="verify_admin"){ 
	if($page!="market_news"){
		if($page!="attribute"){
		if($page!="stock"){
			if($page!="out_on_memo"){
			if($page!="diamond_manage_stock"){
			if($page!="diamond_attribute"){
			if($page!="sub_category"){
			if($page!="category"){
			if($page!="verify_user"){
			if($page!="home_page"){
			if($page!="request_for_quote"){
			if($page!="diamond_request_for_quote"){
			
		
	?> 
		<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script>
			<?php } }}}}}}
	}}
	}}
	}}
	?>  
    <!-- AdminLTE for demo purposes -->      
    <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>  
	<?php  if(($page=="home_page")||($page=="verify_user")||($page=="category")||($page=="sub_category")||($page=="diamond_attribute")||($page=="diamond_manage_stock")||($page=="out_on_memo")||($page=="verify_admin")||($page=="market_news")||($page=="attribute")||($page=="stock")||($page=="request_for_quote")||($page=="diamond_request_for_quote")){ ?> 
	<!-- DataTables -->
    <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
	
		<script>
      $(function () {
		  $("#rfq_table").DataTable({ 
		
autoWidth: false,        
          "searching": false,
		  "scrollY":        "200px",
		   "columnDefs": [ {
          "targets": 'no-sort',
		   "searchable": false, 
		   "orderable": false, 
		   "visible": true
    } ]
        
        });
        $("#example1").DataTable({ 
		fixedHeader: true,
autoWidth: false,        
          "searching": false,
		  "scrollY":        "200px",
		   "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
        
        });
		
		 $("#example5").DataTable({         
          "searching": false,
		  "scrollY":        "200px",
		   "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
        
        });
		$("#example4").DataTable({         
          "searching": false,
		  "scrollY":        "200px",
		   "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
        
        });
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
		  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
		  
        });
		$("#example3").DataTable({         
          "searching": false,
		   "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
        });
      });
    </script>
		<?php } ?>
	<!-- try to add datetime -->
	
	
	
	 <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datetime/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datetime/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datetime/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datetime/bootstrap-datetimepicker.min.js"></script>
	<script>
	var boots =$.noConflict();
	</script>
	<?php
	if(isset($total_memo_history) &&($total_memo_history>0)){
		$i=0;
		foreach($memo_history as $dia_mh){	
			
			$min_date = date("Y-m-d",strtotime("+1 day",  strtotime($dia_mh->request_approve_date)));
			$i++;		
		?>
		<script>
		 boots('#diamond_datepicker_<?php echo $i;?>').datetimepicker({
		 format: 'YYYY-MM-DD HH:mm:ss'
		 
	  
    });
		</script>
		
		<?php		
	}
	} 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if(isset($memo_history_total) &&($memo_history_total>0)){
		$i=0;
		foreach($memo_history as $mh){	
			
			$min_date = strtotime("+1 day",  strtotime($mh->request_approve_date));
			$i++;		
		?>
		<script>
		 boots('#datepicker_<?php echo $i;?>').datetimepicker({
		 format: 'YYYY-MM-DD HH:mm:ss'
      
	  
    });
		</script>
		
		<?php		
	}
	} 
	?>
	<?php
	
	if(isset($total_active_user) &&($total_active_user>0)){
		$p=0;
		foreach($active_user as $a_user){				
			
			$p++;		
		?>
		<script>
		 boots('#a_u_datepicker_<?php echo $p;?>').datetimepicker({
		 format: 'YYYY-MM-DD HH:mm:ss',
		 
    });
		</script>
		
		<?php		
	}
	} 
	?>
	<?php
	
	if(isset($total_pending_user) &&($total_pending_user>0)){
		$k=0;
		foreach($pending_user as $p_user){				
			
			$k++;		
		?>
		<script>
		 boots('#pen_datepicker_<?php echo $k;?>').datetimepicker({
		
            format: 'YYYY-MM-DD HH:mm:ss'
			
	  
    });
		</script>
		
		<?php		
	}
	} 
	?>
	<?php
	
	if(isset($total_disabled_user) &&($total_disabled_user>0)){
		$j=0;
		foreach($disabled_user as $d_user){				
			
			$j++;		
		?>
		<script>
		 boots('#dis_datepicker_<?php echo $j;?>').datetimepicker({
		 format: 'YYYY-MM-DD HH:mm:ss'
		
    
	 
	  
    });
		</script>
		
		<?php		
	}
	} 
	?>
	 <style>
	 .bootstrap-datetimepicker-widget {
		left: 409.5px !important; z-index: 1000 !important; 
  
    
}

    /* RQI: Arrow for Bottom */
    .bootstrap-datetimepicker-widget.bottom:before {
        content: '';
        display: inline-block;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #ccc;
        border-bottom-color: rgba(0, 0, 0, 0.2);
        position: absolute;
        top: -7px;
        left: 7px;
    }

    .bootstrap-datetimepicker-widget.bottom:after {
        content: '';
        display: inline-block;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid white;
        position: absolute;
        top: -6px;
        left: 8px;
    }

    /* RQI: Arrow for Top */
    .bootstrap-datetimepicker-widget.top:before {
        content: '';
        display: inline-block;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 7px solid #ccc;
        border-top-color: rgba(0, 0, 0, 0.2);
        position: absolute;
        bottom: -7px;
        left: 6px;
    }

    .bootstrap-datetimepicker-widget.top:after {
        content: '';
        display: inline-block;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid white;
        position: absolute;
        bottom: -6px;
        left: 7px;
    }

    /* Days Column Width */
    .bootstrap-datetimepicker-widget .dow {
        width: 14.2857%;
    }

    .bootstrap-datetimepicker-widget.pull-right:before {
        left: auto;
        right: 6px;
    }

    .bootstrap-datetimepicker-widget.pull-right:after {
        left: auto;
        right: 7px;
    }

    .bootstrap-datetimepicker-widget > ul {
        list-style-type: none;
        margin: 0;
    }

    .bootstrap-datetimepicker-widget .timepicker-hour,
    .bootstrap-datetimepicker-widget .timepicker-minute,
    .bootstrap-datetimepicker-widget .timepicker-second {
        width: 100%;
        font-size: 20px;
    }

    .bootstrap-datetimepicker-widget table[data-hour-format="12"] .separator {
        width: 4px;
        padding: 0;
        margin: 0;
    }

    .bootstrap-datetimepicker-widget .datepicker > div {
        display: none;
    }

    .bootstrap-datetimepicker-widget .picker-switch {
        text-align: center;
    }

    .bootstrap-datetimepicker-widget table {
        width: 100%;
        margin: 0;
    }

    .bootstrap-datetimepicker-widget td,
    .bootstrap-datetimepicker-widget th {
        text-align: center;
        border-radius: 4px;
    }

        .bootstrap-datetimepicker-widget td.day:hover,
        .bootstrap-datetimepicker-widget td.hour:hover,
        .bootstrap-datetimepicker-widget td.minute:hover,
        .bootstrap-datetimepicker-widget td.second:hover {
            background: #eeeeee;
            cursor: pointer;
        }

        .bootstrap-datetimepicker-widget td.old,
        .bootstrap-datetimepicker-widget td.new {
            color: #c7c7c7;
        }

        /* Today */
        .bootstrap-datetimepicker-widget td.today {
            position: relative;
        }

        .bootstrap-datetimepicker-widget td.today:before {
            content: '';
            display: inline-block;
            border-left: 7px solid transparent;
            border-bottom: 7px solid #389b98;
            border-top-color: rgba(0, 0, 0, 0.2);
            position: absolute;
            bottom: 4px;
            right: 4px;
        }

        .bootstrap-datetimepicker-widget td.active.today:before {
            border-bottom-color: #fff;
        }

        .bootstrap-datetimepicker-widget td.active,
        .bootstrap-datetimepicker-widget td.active:hover {
            background-color: #389b98;
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        }

        .bootstrap-datetimepicker-widget td.disabled,
        .bootstrap-datetimepicker-widget td.disabled:hover {
            background: none;
            color: #999999;
            cursor: not-allowed;
        }

        .bootstrap-datetimepicker-widget td span {
            display: block;
            width: 47px;
            float: left;
            margin: 2px;
            cursor: pointer;
            border-radius: 4px;
            padding: 5px 0 5px 0;
        }

            .bootstrap-datetimepicker-widget td span:hover {
                background: #eeeeee;
            }

            .bootstrap-datetimepicker-widget td span.active {
                background-color: #428bca;
                color: #fff;
                text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
            }

            .bootstrap-datetimepicker-widget td span.old {
                color: #999999;
            }

            .bootstrap-datetimepicker-widget td span.disabled,
            .bootstrap-datetimepicker-widget td span.disabled:hover {
                background: none;
                color: #999999;
                cursor: not-allowed;
            }

        .bootstrap-datetimepicker-widget th.switch {
            width: 145px;
        }

        .bootstrap-datetimepicker-widget th.next,
        .bootstrap-datetimepicker-widget th.prev {
            font-size: 21px;
        }

        .bootstrap-datetimepicker-widget th.disabled,
        .bootstrap-datetimepicker-widget th.disabled:hover {
            background: none;
            color: #999999;
            cursor: not-allowed;
        }

    .bootstrap-datetimepicker-widget thead tr:first-child th {
        cursor: pointer;
    }

        .bootstrap-datetimepicker-widget thead tr:first-child th:hover {
            background: #eeeeee;
        }

.input-group.date .input-group-addon span {
    display: block;
    cursor: pointer;
    width: 16px;
    height: 16px;
}

.bootstrap-datetimepicker-widget.left-oriented:before {
    left: auto;
    right: 6px;
}

.bootstrap-datetimepicker-widget.left-oriented:after {
    left: auto;
    right: 7px;
}

.bootstrap-datetimepicker-widget ul.list-unstyled li.in div.timepicker div.timepicker-picker table.table-condensed tbody > tr > td {
    padding: 0;
}

/* Customized Button */
.btn-time, .btn-time:focus {
    color: #389b98;
    text-decoration: none;
    background-color: transparent;
}

    .btn-time i {
        padding: 0 7px 0 7px;
    }

    .btn-time:hover {
        color: #12615F;
        text-decoration: none;
        background-color: #eee;
    }


	 </style>
	
  </body>
</html>
