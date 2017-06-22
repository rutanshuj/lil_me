<?php
public function xyz(){
		$save_data=$testing=array();
		if(isset($_FILES["userfile"]["tmp_name"]) && ($_FILES["userfile"]["tmp_name"]!="")){
		$count=0;
			$save_count=$update_count="0";
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES["userfile"]["tmp_name"]);

			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$worksheetTitle     = $worksheet->getTitle();
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			 $highestColumn      = 'M'; // e.g 'F'
			 $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
			
	
		  
		  
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);
		
			$first=$second=$third="";
			for ($row = 2; $row <= $arrayCount; ++ $row)
			{
			  
			   $sl_number= trim($allDataInSheet[$row]["A"]);
			   
			  if(trim($allDataInSheet[$row]["A"])!=""){
				$first=trim($allDataInSheet[$row]["A"]);
			  }
			  
			  
			   $save_data['Tag']=$first;
			   
			   if(trim($allDataInSheet[$row]["B"])!=""){
				$second=trim($allDataInSheet[$row]["B"]);
			  }
			  
			   $save_data['Item_Particulars']=$second;
			   
			   if(trim($allDataInSheet[$row]["C"])!=""){
				$third=trim($allDataInSheet[$row]["C"]);
			  }
			   $save_data['Category']=$third;
			   $save_data['size']=trim($allDataInSheet[$row]["D"]);
			   $save_data['quantity']=trim($allDataInSheet[$row]["E"]);
			   $save_data['Color']=trim($allDataInSheet[$row]["F"]);
			   $save_data['PCs']=trim($allDataInSheet[$row]["G"]);
			   $save_data['Metal_Purity']=trim($allDataInSheet[$row]["H"]);
			   $save_data['Gr_Wt']=trim($allDataInSheet[$row]["I"]);
			   $save_data['Net_Wt']=trim($allDataInSheet[$row]["J"]);
			   $save_data['Total_Color_Stone_Wt']=trim($allDataInSheet[$row]["K"]);
			   $save_data['Total_Diamonds_Weight']=trim($allDataInSheet[$row]["L"]);
			   $save_data['Total_Color_Stone_Value']=trim($allDataInSheet[$row]["M"]);
			   $save_data['Total_Diamond_Value']=trim($allDataInSheet[$row]["N"]);
			   $save_data['Colour_Clarity']=trim($allDataInSheet[$row]["O"]);
			   $save_data['Total_No_of_Pieces']=trim($allDataInSheet[$row]["P"]);
			   $save_data['Labour']=trim($allDataInSheet[$row]["Q"]);
			   $save_data['C_NO']=trim($allDataInSheet[$row]["S"]);
			   $save_data['Total_Amount']=trim($allDataInSheet[$row]["T"]);
			   $save_data['Notes_Comments']=trim($allDataInSheet[$row]["U"]);
			  ///// take value is in database or not 
			  $testing[]=array(
			  'Tag'=>$first,
			  'Item_Particulars'=>$second,
			  'Category'=>$save_data['Category'],
			  'size'=>$save_data['size'],
			  'quantity'=>$save_data['quantity'],
			  'Color'=>$save_data['Color'],
			  'PCs'=>$save_data['PCs'],
			  'Metal_Purity'=>$save_data['Metal_Purity'],
			  'Gr_Wt'=>$save_data['Gr_Wt'],
			  'Net_Wt'=>$save_data['Net_Wt'],
			  'Total_Color_Stone_Wt'=>$save_data['Total_Color_Stone_Wt'],
			  'Total_Diamonds_Weight'=>$save_data['Total_Diamonds_Weight'],
			  'Total_Color_Stone_Value'=>$save_data['Total_Color_Stone_Value'],
			  'Total_Diamond_Value'=>$save_data['Total_Diamond_Value'],
			  'Colour_Clarity'=>$save_data['Colour_Clarity'],
			  'Total_No_of_Pieces'=>$save_data['Total_No_of_Pieces'],
			  'Labour'=>$save_data['Labour'],
			  'C_NO'=>$save_data['C_NO'],
			  'Total_Amount'=>$save_data['Total_Amount'],
			  'Notes_Comments'=>$save_data['Notes_Comments'],
			  );
						
			
				 	
				}
		
			
			
		
			
			
		   }
		   } else {
			$this->session->set_flashdata('error', 'Please select excel file');
			//redirect('admin/exhibitors');
		
		}
		echo "<pre>";
		print_r($testing);
		
	}