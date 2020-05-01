<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
    <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
	  <div class="os-tabs-w menu-shad">
		<div class="os-tabs-controls">
		  <ul class="navs navs-tabs upper">			
			<li class="navs-item">			  
				<a class="navs-links active" href="<?php echo base_url();?>admin/fees/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
				<span><?php echo get_phrase('Fee Structure');?></span></a>
			</li>
			<li class="navs-item">        
			  <a class="navs-links" href="<?php echo base_url();?>admin/add_fees_structure/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
			  <span><?php echo get_phrase('Add Structure');?></span></a>
			</li>
			<li class="navs-item">        
			  <a class="navs-links" href="<?php echo base_url();?>admin/fees_concession/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
			  <span><?php echo get_phrase('Add Concession');?></span></a>
			</li>
			<li class="navs-item">        
			  <a class="navs-links" href="<?php echo base_url();?>admin/fees_discount/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
			  <span><?php echo get_phrase('Add Discount');?></span></a>
			</li>
		   </ul>		
		</div>
	</div>
    <div class="content-i">
    	<div class="content-box">
	    <div class="row">
    		<div class="col-sm-3">
		        <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo get_phrase('class');?></label>
                    <div class="select">
                        <select name="class_id">
                            <option value=""><?php echo get_phrase('select');?></option>
                            <?php
    					        $classes = $this->db->get('class')->result_array();
					            foreach($classes as $row):                        
				            ?> 
                            	<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>    
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
		    </div>
		    <div class="col-sm-3">
		        <button class="btn btn-success" id ="view_fees_structure" style="margin-top:10px" type="submit"><?php echo get_phrase('view');?></button>
		    </div>
	    </div>
    	<input type="hidden" name="year" value="<?php echo $running_year;?>">
        </div>
    </div>
    </div>
</div>