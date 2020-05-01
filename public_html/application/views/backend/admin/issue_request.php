<div class="content-w">
 <?php include 'fancy.php';?>
 <div class="header-spacer"></div>
<!--	<div class="content-i">
		<div class="content-box">-->
			<div class="conty">
				<div class="os-tabs-w menu-shad">		
					<div class="os-tabs-controls">		  
						<ul class="navs navs-tabs upper">			
							<li class="navs-item">			  
								<a class="navs-links " href="<?php echo base_url();?>admin/library/"><i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
								<span><?php echo get_phrase('library');?></span></a>
							</li>
							<li class="navs-item">			  
								<a class="navs-links" href="<?php echo base_url();?>admin/book_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
								<span><?php echo get_phrase('book_request');?></span></a>
							</li>
							<li class="navs-item">        
							  <a class="navs-links active" href="<?php echo base_url();?>admin/issue_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							  <span><?php echo get_phrase('issue_book');?></span></a>
							</li>
							 <li class="navs-item">        
							  <a class="navs-links" href="<?php echo base_url();?>admin/return_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							  <span><?php echo get_phrase('return_book');?></span></a>
							</li>
						</ul>		
					</div>
				</div>  
				<div class="ui-block">
					<div class="ui-block-content">
      						<div class="steps-w">
        						<div class="step-contents">
          							<div class="step-content active" id="stepContent1">
											<!--<label class="control-label">Issue new Book</label>-->
									    <div class="row">	
										<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
    											<label class="control-label">Booking Details</label>
						    			    </div>
											<hr></hr>
										
    										<div class="col col-lg-3 col-md-3 col-sm-12 col-12">
											    <div class="form-group label-floating">
    												<label class="control-label">Student id</label>
												    <input class="form-control" name="student_id" id="student_id" type="text" required="" onkeyup="validatestudent()" required="">
											    </div>
						    			    </div>							
										    <div class="col col-lg-3 col-md-3 col-sm-12 col-12">
    											<div class="form-group label-floating">
												    <label class="control-label">Barcode</label>
												    <input class="form-control" name="barcode" id="barcode" type="text" required="" onkeyup="validatebarcode()" required="">
											    </div>								
						   				    </div>						   	
						   				    <div class="col col-lg-3 col-md-3 col-sm-12 col-12">								
    											<div class="form-group date-time-picker label-floating">
												    <label class="control-label">Date of issue</label>
                                                    <input type='text' class="datepicker-here" data-position="bottom left" data-language='en' name="datetimepicker" id="datetimepicker" data-multiple-dates-separator="/"/>
											    </div>
						    			    </div>
						    			    <div class="col col-lg-3 col-md-3 col-sm-12 col-12">								
    											<div class="form-group date-time-picker label-floating">
												    <label class="control-label">Date of return</label>
                                                    <input type='text' class="datepicker-here" data-position="bottom left" data-language='en' name="datetimepicker1" id="datetimepicker1" data-multiple-dates-separator="/"/>
											    </div>
						    			    </div>	
										</div>
										<div id="verify-student">
										</div>
										<div id="verify-barcode">
										</div>
									</div>
                    	                <div class="form-buttons-w text-right">
                        		            <button class="btn btn-rounded btn-success btn-lg" type="submit" id="sub_form" onclick="bookissue()">Issue book</button>
                		                </div>
            		                </div>
        		            </div>
        		        </div> 
        		       
		            </div>
	            </div>
	        </div>
	    </div>
	<!--</div>
</div>-->
