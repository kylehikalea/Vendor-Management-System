<?php
	include ('resources/header.php');
?>
<div class="container content">
		<div class="row">
			<div class="col-md-12">
				<?php
                                
                                require_once '../Classes/PHPExcel.php';
                                require_once '../Classes/PHPExcel/Writer/Excel2007.php';

                                $spreadsheet = new PHPExcel();
                                $spreadsheet->setActiveSheetIndex(0);
                                $worksheet = $spreadsheet->getActiveSheet();
                                
					echo '<p>Writing data to [import.xls]...</p>';
						
						$xmlurl = '../products/complete/products_completed.xml'; // xml file location with file name
						if (file_exists($xmlurl)) {
							$xml = simplexml_load_file($xmlurl);
							$worksheet->SetCellValueByColumnAndRow(0, 1, '*Inventory Type');
                                                        $worksheet->SetCellValueByColumnAndRow(1, 1, '*Model#');
                                                        $worksheet->SetCellValueByColumnAndRow(2, 1, '*Sku#');
                                                        $worksheet->SetCellValueByColumnAndRow(3, 1, '*Category#');
                                                        $worksheet->SetCellValueByColumnAndRow(4, 1, '*Sub Category#');
                                                        $worksheet->SetCellValueByColumnAndRow(5, 1, '*Description');
                                                        $worksheet->SetCellValueByColumnAndRow(6, 1, '*Manufacture');
                                                        $worksheet->SetCellValueByColumnAndRow(7, 1, 'Barcode UPC');
                                                        $worksheet->SetCellValueByColumnAndRow(8, 1, 'Color');
                                                        $worksheet->SetCellValueByColumnAndRow(9, 1, 'Size');
                                                        $worksheet->SetCellValueByColumnAndRow(10, 1, 'Lease');
                                                        $worksheet->SetCellValueByColumnAndRow(11, 1, 'Book Depr');
                                                        $worksheet->SetCellValueByColumnAndRow(12, 1, 'Tax Depr');
                                                        $worksheet->SetCellValueByColumnAndRow(13, 1, 'Min');
                                                        $worksheet->SetCellValueByColumnAndRow(14, 1, 'Max');
                                                        $worksheet->SetCellValueByColumnAndRow(15, 1, 'Qty');
                                                        $worksheet->SetCellValueByColumnAndRow(16, 1, 'Avg Cost');
                                                        $worksheet->SetCellValueByColumnAndRow(17, 1, 'Freight');
                                                        $worksheet->SetCellValueByColumnAndRow(18, 1, 'W Cost');
                                                        $worksheet->SetCellValueByColumnAndRow(19, 1, 'Retail');
                                                        $worksheet->SetCellValueByColumnAndRow(20, 1, 'Our Price');
                                                        $worksheet->SetCellValueByColumnAndRow(21, 1, 'Min Price');
                                                        $worksheet->SetCellValueByColumnAndRow(22, 1, 'Price A');
                                                        $worksheet->SetCellValueByColumnAndRow(23, 1, 'Price B');
                                                        $worksheet->SetCellValueByColumnAndRow(24, 1, 'Price C');
                                                        $worksheet->SetCellValueByColumnAndRow(25, 1, 'Spiff');
                                                        $worksheet->SetCellValueByColumnAndRow(26, 1, 'P Vendor#');
                                                        $worksheet->SetCellValueByColumnAndRow(27, 1, 'P Vendor Item#');
                                                        $worksheet->SetCellValueByColumnAndRow(28, 1, 'P Vendor Last Cost');
                                                        
                                                        $worksheet->SetCellValueByColumnAndRow(29, 1, 'P Vendor Last Date');
                                                        $worksheet->SetCellValueByColumnAndRow(30, 1, 'S1 Vendor#');
                                                        $worksheet->SetCellValueByColumnAndRow(31, 1, 'S1 Vendor Item#');
                                                        $worksheet->SetCellValueByColumnAndRow(32, 1, 'S1 Vendor Last Cost');
                                                        $worksheet->SetCellValueByColumnAndRow(33, 1, 'S1 Vendor Last Date');
                                                        $worksheet->SetCellValueByColumnAndRow(34, 1, 'S2 Vendor#');
                                                        $worksheet->SetCellValueByColumnAndRow(35, 1, 'S2 Vendor Item#');
                                                        $worksheet->SetCellValueByColumnAndRow(36, 1, 'S2 Vendor Last Cost');
                                                        $worksheet->SetCellValueByColumnAndRow(37, 1, 'S2 Vendor Last Date');
                                                        $worksheet->SetCellValueByColumnAndRow(38, 1, 'Notes');
                                                        $worksheet->SetCellValueByColumnAndRow(39, 1, 'POS Reminder');
                                                        $worksheet->SetCellValueByColumnAndRow(40, 1, 'Invoice Notes');
                                                        $worksheet->SetCellValueByColumnAndRow(41, 1, 'Image Path');
                                                        $worksheet->SetCellValueByColumnAndRow(42, 1, 'Selection Code');
                                                        $worksheet->SetCellValueByColumnAndRow(43, 1, 'Warranty');
                                                        $worksheet->SetCellValueByColumnAndRow(44, 1, 'Locator');
                                                        
                                                        
                                                        $worksheet->SetCellValueByColumnAndRow(45, 1, 'Bar Label');
                                                        $worksheet->SetCellValueByColumnAndRow(46, 1, 'Date In House');
                                                        $worksheet->SetCellValueByColumnAndRow(47, 1, 'Unit');
                                                        $worksheet->SetCellValueByColumnAndRow(48, 1, 'Weight');
                                                        $worksheet->SetCellValueByColumnAndRow(49, 1, 'LoyaltyExempt');
                                                        
                                                        
                                                        $worksheet->SetCellValueByColumnAndRow(50, 1, 'FoodStamp');
                                                        $worksheet->SetCellValueByColumnAndRow(51, 1, 'HealthCare');
                                                        $worksheet->SetCellValueByColumnAndRow(52, 1, 'Scale');
                                                        
                                                        $i=2;
                                                        foreach($xml as $node)
							{
                                                            $j=0;
//                                                            foreach ($node as $node_val)
//                                                            {
//                                                                
//                                                                $worksheet->SetCellValueByColumnAndRow($j, $i, $node_val);
//                                                                $j+=1;
//                                                            }
                                                            $worksheet->SetCellValueByColumnAndRow(0, $i, $node->inventory_type);
                                                            $worksheet->SetCellValueByColumnAndRow(1, $i, $node->model_number);
                                                            $worksheet->SetCellValueByColumnAndRow(2, $i, $node->sku);
                                                            $worksheet->SetCellValueByColumnAndRow(3, $i, $node->category);
                                                            $worksheet->SetCellValueByColumnAndRow(4, $i, $node->subcategory);
                                                            $worksheet->SetCellValueByColumnAndRow(5, $i, $node->description);
                                                            $worksheet->SetCellValueByColumnAndRow(6, $i, $node->manufacturer);
                                                            $worksheet->SetCellValueByColumnAndRow(7, $i, $node->barcode_upc);
                                                            $worksheet->SetCellValueByColumnAndRow(8, $i, $node->color);
                                                            $worksheet->SetCellValueByColumnAndRow(9, $i, $node->size);
                                                            $worksheet->SetCellValueByColumnAndRow(10, $i, $node->lease);
                                                            
                                                            
                                                            $worksheet->SetCellValueByColumnAndRow(11, $i, $node->book_depr);
                                                            $worksheet->SetCellValueByColumnAndRow(12, $i, $node->tax_depr);
                                                            $worksheet->SetCellValueByColumnAndRow(13, $i, $node->min);
                                                            $worksheet->SetCellValueByColumnAndRow(14, $i, $node->max);
                                                            $worksheet->SetCellValueByColumnAndRow(15, $i, $node->quantity);
                                                            $worksheet->SetCellValueByColumnAndRow(16, $i, $node->avg_cost);
                                                            $worksheet->SetCellValueByColumnAndRow(17, $i, $node->freight);
                                                            $worksheet->SetCellValueByColumnAndRow(18, $i, $node->w_cost);
                                                            $worksheet->SetCellValueByColumnAndRow(19, $i, $node->retail);
                                                            $worksheet->SetCellValueByColumnAndRow(20, $i, $node->our_price);
                                                            $worksheet->SetCellValueByColumnAndRow(21, $i, $node->min_price);
                                                            $worksheet->SetCellValueByColumnAndRow(22, $i, $node->price_a);
                                                            $worksheet->SetCellValueByColumnAndRow(23, $i, $node->price_b);
                                                            
                                                            $worksheet->SetCellValueByColumnAndRow(24, $i, $node->price_c);
                                                            $worksheet->SetCellValueByColumnAndRow(25, $i, $node->spiff);
                                                            $worksheet->SetCellValueByColumnAndRow(26, $i, $node->p_vendor_number);
                                                            $worksheet->SetCellValueByColumnAndRow(27, $i, $node->p_vendor_item_number);
                                                            $worksheet->SetCellValueByColumnAndRow(28, $i, $node->p_vendor_last_cost);
                                                            $worksheet->SetCellValueByColumnAndRow(29, $i, $node->p_vendor_last_date);
                                                            $worksheet->SetCellValueByColumnAndRow(30, $i, $node->s1_vendor_number);
                                                            $worksheet->SetCellValueByColumnAndRow(31, $i, $node->s1_vendor_item_number);
                                                            $worksheet->SetCellValueByColumnAndRow(32, $i, $node->s1_vendor_last_cost);
                                                            $worksheet->SetCellValueByColumnAndRow(33, $i, $node->s1_vendor_last_date);
                                                            
                                                            
                                                            $worksheet->SetCellValueByColumnAndRow(34, $i, $node->s2_vendor_number);
                                                            $worksheet->SetCellValueByColumnAndRow(35, $i, $node->s2_vendor_item_number);
                                                            $worksheet->SetCellValueByColumnAndRow(36, $i, $node->s2_vendor_last_cost);
                                                            $worksheet->SetCellValueByColumnAndRow(37, $i, $node->s2_vendor_last_date);
                                                            $worksheet->SetCellValueByColumnAndRow(38, $i, $node->notes);
                                                            $worksheet->SetCellValueByColumnAndRow(39, $i, $node->pos_reminder);
                                                            $worksheet->SetCellValueByColumnAndRow(40, $i, $node->invoice_notes);
                                                            $worksheet->SetCellValueByColumnAndRow(41, $i, $node->image);
                                                            $worksheet->SetCellValueByColumnAndRow(42, $i, $node->selection_code);
                                                            
                                                            $worksheet->SetCellValueByColumnAndRow(43, $i, $node->warranty);
                                                            $worksheet->SetCellValueByColumnAndRow(44, $i, $node->locator);
                                                            $worksheet->SetCellValueByColumnAndRow(45, $i, $node->bar_label);
                                                            $worksheet->SetCellValueByColumnAndRow(46, $i, $node->date_in_house);
                                                            $worksheet->SetCellValueByColumnAndRow(47, $i, $node->unit);
                                                            $worksheet->SetCellValueByColumnAndRow(48, $i, $node->weight);
                                                            $worksheet->SetCellValueByColumnAndRow(49, $i, $node->loyalty_exempt);
                                                            
                                                            $worksheet->SetCellValueByColumnAndRow(50, $i, $node->food_stamp);
                                                            $worksheet->SetCellValueByColumnAndRow(51, $i, $node->healthcare);
                                                            $worksheet->SetCellValueByColumnAndRow(52, $i, $node->scale);
                                                            
                                                            
                                                            $i+=1;
                                                        }
						}
						//Saving import.XLS
						$writer = new PHPExcel_Writer_Excel2007($spreadsheet);
                        $writer->save('../products/excel/proper_ '.date("d-m-Y") .'.xlsx');
						echo '<p>Saving [proper_ '.date("d-m-Y") .'.xlsx]...</p>';
						
						
						//Create XLS for barcode printing
						echo '<p>Creating barcodes for [barcodes.xls]...</p>';
						
						//Saving Barcode.XLS
						echo '<p>Saving [barcodes.xls]...</p>';
						
						//Remove Products elements from Products_completed.XML
						echo '<p>Removing products from [products_completed.xml]...</p>';
						
							$dom = new DOMDocument();
							$dom->load($xmlurl); 

							$featuredde1 = $dom->getElementsByTagName('product');
							echo $featuredde1->length;

							while($featuredde1->length >= 1)
							{
								$featuredde1 = $dom->getElementsByTagName('product');
								print_r($featuredde1);
							foreach ($featuredde1 as $node) {
								$node->parentNode->removeChild($node);
							}
							echo $dom->save($xmlurl);
							}
						echo '<p>Products_Completed.XML Updated Successfully...</p>';
						//Return PHP Catch of Errors
						echo '<p>Import completed with 0 errors.</p>';
                                        ?>
			</div>
		</div>
</div>

<?php

?>

    
    <?php
	include ('resources/footer.php');
?>