<?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
<div class="content-w">
 <?php include 'fancy.php';?>
 <div class="header-spacer"></div>
	<!--<div class="content-i">
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
							  <a class="navs-links " href="<?php echo base_url();?>admin/issue_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							  <span><?php echo get_phrase('issue_book');?></span></a>
							</li>
							 <li class="navs-item active">        
							  <a class="navs-links" href="<?php echo base_url();?>admin/return_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							  <span><?php echo get_phrase('return_book');?></span></a>
							</li>
						</ul>		
					</div>
				</div>  
				<div class="ui-block">
					<div class="ui-block-content">
      						<div class="steps-w"> 
      						<div class="steps-w"> 
        						<div class="step-contents">
          							<div class="step-content active" id="stepContent1">
											<h6 class="title"><?php echo get_phrase('return_book');?></label>
											<hr></hr>
									    <div class="row">	
    										<div class="col col-lg-4 col-md-4 col-sm-12 col-12">
											    <div class="form-group label-floating">
    												<label class="control-label"><?php echo get_phrase('student_id');?></label>
												    <input class="form-control" name="student_id" id="student_id" type="text" required="" onkeyup="getstudent()">
											    </div>
						    			    </div>
											<div class="col col-lg-4 col-md-4 col-sm-12 col-12">								
												<div class="form-group date-time-picker label-floating">
													<label class="control-label">Barcode</label>
													<input type='text' id ="barcode" data-position="bottom left" name="barcode"/>
												</div>
											</div>		
											<div class="col col-lg-4 col-md-4 col-sm-12 col-12">								
												<div class="form-group date-time-picker label-floating">
													<label class="control-label">Date of return</label>
													<input type='text' class="datepicker-here" id ="returnDate" data-position="bottom left" data-language='en' name="datetimepicker" data-multiple-dates-separator="/"/>
												</div>
											</div>
											<div class="col col-lg-4 col-md-4 col-sm-12 col-12">  
												<div class="form-group label-floating">
													<label class="control-label">Fine amount</label>
													<input class="form-control" name="fine_amount" type="text" required="">
												</div>
											</div>
										</div>
										<div id="verify-student">
										</div>
										<div id="verify-barcode">
										</div>
                    	                <div class="form-buttons-w text-right">
                        		            <button class="btn btn-rounded btn-success btn-lg" id="return_book_btn" type="submit" id="sub_form">Return book</button>
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