<?php include 'fancy.php';?>
<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
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
						<a class="navs-links" href="<?php echo base_url();?>admin/add_fees_structure/"><i
								class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							<span><?php echo get_phrase('Add Structure');?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links active" href="<?php echo base_url();?>admin/fees_concession/"><i
								class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
							<span><?php echo get_phrase('Add Concession');?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links " href="<?php echo base_url();?>admin/fees_discount/"><i
								class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
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
								<select name="class_id" id="class_id" required="" onchange="get_class_sections(this.value)">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php 
                                        $class = $this->db->get('class')->result_array();
                                        foreach ($class as $row): ?>
									<option value="<?php echo $row['class_id']; ?>"
										<?php if($class_id == $row['class_id']) echo "selected";?>>
										<?php echo $row['name']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('section');?></label>
							<div class="select">
								<?php if($section_id == ""):?>
								<select name="section_id" required id="section_holder"
									onchange="get_student(this.value)">
									<option value=""><?php echo get_phrase('select');?></option>
								</select>
								<?php else:?>
								<select name="section_id" required id="section_holder"
									onchange="get_student(this.value)">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php 
            									$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
            									foreach ($sections as $key):
            								?>
									<option value="<?php echo $key['section_id'];?>"
										<?php if($section_id == $key['section_id']) echo "selected";?>>
										<?php echo $key['name'];?></option>
									<?php endforeach;?>
								</select>
								<?php endif;?>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('student');?></label>
							<div class="select">
								<?php if($student_id == ""):?>
								<select name="student_id" required id="student_holder">
									<option value=""><?php echo get_phrase('select');?></option>
								</select>
								<?php else:?>
								<select name="student_id" required id="student_holder">
									<option value=""><?php echo get_phrase('select');?></option>
									<?php 
            									$students = $this->db->get_where('enroll', array('class_id' => $class_id))->result_array();
            									foreach ($students as $key):
            								?>
									<option value="<?php echo $key['student_id'];?>"
										<?php if($student_id == $key['student_id']) echo "selected";?>>
										<?php echo $this->crud_model->get_name('student', $key['student_id']);?>
									</option>
									<?php endforeach;?>
								</select>
								<?php endif;?>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('running_year');?></label>
							<div class="select">
								<select name="running_year" id="running_year_id" required="">
									<?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
									<option value=""><?php echo get_phrase('select');?></option>
									<?php for($i = 0; $i < 10; $i++):?>
									<option value="<?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>"
										<?php if($running_year == (2016+$i).'-'.(2016+$i+1)) echo 'selected';?>>
										<?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>
									</option>
									<?php endfor;?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('from month');?></label>
							<div class="select">
								<select id="from_month_id">
									<!--<option value=""><?php echo get_phrase('select');?></option>-->
									<?php
    					        $monthes = $this->db->get('month_table')->result_array();
					            foreach($monthes as $row):                        
				            ?>
									<option value="<?php echo $row['month_id'];?>"><?php echo $row['month'];?></option>
									<?php if($month_id == $row['month_id']) echo "selected";?>>
										<?php echo $row['month_id'];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group label-floating is-select">
							<label class="control-label"><?php echo get_phrase('to month');?></label>
							<div class="select">
								<select id="to_month_id">
									<!--<option value=""><?php echo get_phrase('select');?></option>-->
									<?php
    					        $monthes = $this->db->get('month_table')->result_array();
					            foreach($monthes as $row):                        
				            ?>
									<option value="<?php echo $row['month_id'];?>"><?php echo $row['month'];?></option>
									<?php if($month_id == $row['month_id']) echo "selected";?>>
										<?php echo $row['month_id'];?></option>
									
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group label-floating ui-block">
							<label class="control-label"><?php echo get_phrase('Amount');?></label>
							<input class="form-control" id="amount" name="Amount" type="text" required="">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<button class="btn btn-success btn-upper" id="add_concession" style="margin-top:10px" onclick="addConcession()"
								type="submit"><?php echo get_phrase('add');?><span>    <i class="picons-thin-icon-thin-0154_ok_successful_check"></i></span></button>
						</div>
					</div>

				</div>
				<input type="hidden" name="year" value="<?php echo $running_year;?>">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function get_class_sections(class_id) {
		$.ajax({
			url: '<?php echo base_url();?>admin/get_class_section/' + class_id,
			success: function (response) {
				jQuery('#section_holder').html(response);
			}
		});
	}
</script>

<script type="text/javascript">
	function get_student(section_id) {
		$.ajax({
			url: '<?php echo base_url();?>admin/get_class_studentss/' + section_id,
			success: function (response) {
				jQuery('#student_holder').html(response);
			}
		});
	}
</script>