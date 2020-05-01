<div class="content-w">
	<div class="conty">
		<?php include 'fancy.php';?>
		<div class="header-spacer"></div>
		<div class="os-tabs-w menu-shad">
			<div class="os-tabs-controls">
				<ul class="navs navs-tabs upper">
					<li class="navs-item">
						<a class="navs-links " href="<?php echo base_url();?>admin/fees/"><i
								class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							<span><?php echo get_phrase('Fee Structure');?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links active" href="<?php echo base_url();?>admin/add_fees_structure/"><i
								class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							<span><?php echo get_phrase('Add Structure');?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url();?>admin/fees_concession/"><i
								class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							<span><?php echo get_phrase('Add Concession');?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url();?>admin/fees_discount/"><i
								class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							<span><?php echo get_phrase('Add Discount');?></span></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content-i">
			<div class="content-box">
				<div class="row">
					<div class="col-sm-2">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('class');?></label>
							<div class="select">
								<select id="class_id">
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
					<div class="col-sm-2">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('Type');?></label>
							<div class="select">
								<select id="type_id">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php
    					        $types = $this->db->get('type_table')->result_array();
					            foreach($types as $row):                        
				            ?>
									<option value="<?php echo $row['type_id'];?>"><?php echo $row['type'];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('Month');?></label>
							<div class="select">
								<select id="month_id">
									<!--<option value=""><?php echo get_phrase('select');?></option>-->
									<?php
    					        $monthes = $this->db->get('month_table')->result_array();
					            foreach($monthes as $row):                        
				            ?>
									<option value="<?php echo $row['month_id'];?>"><?php echo $row['month'];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group label-floating ui-block">
							<label class="control-label"><?php echo get_phrase('Amount');?></label>
							<input class="form-control" id="amount" name="Amount" type="text" required="">
						</div>
					</div>
					<div class="col col-lg-2 col-md-3 col-sm-12 col-12">
						<div class="form-group date-time-picker ui-block label-floating">
							<label class="control-label">Last date</label>
							<input type='text' id="last_submsn_date" class="datepicker-here" data-position="bottom left"
								data-language='en' name="datetimepicker1" id="datetimepicker1"
								data-multiple-dates-separator="/" />
						</div>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-success" id="add_fees_structure_btn" style="margin-top:10px"
							type="submit"><?php echo get_phrase('add');?></button>
					</div>
				</div>
				<!--end row-->
				<div>

				</div>
			</div>
		</div>
	</div>
</div>