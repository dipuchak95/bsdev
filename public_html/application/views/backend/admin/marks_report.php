	<div class="content-w">
		<?php include 'fancy.php';?>
		<div class="header-spacer"></div>
		<div class="conty">
			<div class="os-tabs-w menu-shad">
				<div class="os-tabs-controls">
					<ul class="navs navs-tabs">
						<li class="navs-item">
							<a class="navs-links" href="<?php echo base_url();?>admin/general_reports/"><i
									class="picons-thin-icon-thin-0658_cup_place_winner_award_prize_achievement"></i>
								<span><?php echo get_phrase('classes');?></span></a>
						</li>
						<li class="navs-item">
							<a class="navs-links" href="<?php echo base_url();?>admin/students_report/"><i
									class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
								<span><?php echo get_phrase('students');?></span></a>
						</li>
						<li class="navs-item">
							<a class="navs-links" href="<?php echo base_url();?>admin/attendance_report/"><i
									class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i>
								<span><?php echo get_phrase('attendance');?></span></a>
						</li>
						<li class="navs-item">
							<a class="navs-links <?php if($page_name == 'marks_report') echo "active";?>"
								href="<?php echo base_url();?>admin/marks_report/"><i
									class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i>
								<span><?php echo get_phrase('final_marks');?></span></a>
						</li>
						<li class="navs-item">
							<a class="navs-links" href="<?php echo base_url();?>admin/tabulation_report/"><i
									class="picons-thin-icon-thin-0070_paper_role"></i>
								<span><?php echo get_phrase('tabulation_sheet');?></span></a>
						</li>
						<li class="navs-item">
							<a class="navs-links" href="<?php echo base_url();?>admin/accounting_report/"><i
									class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i>
								<span><?php echo get_phrase('accounting');?></span></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="content-i">
				<div class="content-box">
					<h5 class="form-header"><?php echo get_phrase('student_card');?></h5>
					<hr>
					<?php echo form_open(base_url() . 'admin/marks_report/', array('class' => 'form m-b'));?>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group label-floating is-select">
								<label class="control-label"><?php echo get_phrase('class');?></label>
								<div class="select">
									<select name="class_id" required="" onchange="get_class_sections(this.value)">
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
						<div class="col-sm-2">
							<div class="form-group label-floating is-select">
								<label class="control-label"><?php echo get_phrase('semester');?></label>
								<div class="select">
									<select name="exam_id" required>
										<option value=""><?php echo get_phrase('select');?></option>
										<option value="All"><?php echo get_phrase('All exam');?></option>
										<?php $exam = $this->db->get('exam')->result_array();
            						foreach($exam as $row):
            							?>
										<option value="<?php echo $row['exam_id'];?>"
											<?php if($exam_id == $row['exam_id']) echo "selected";?>>
											<?php echo $row['name'];?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-1">
							<div class="form-group">
								<button class="btn btn-success btn-upper" style="margin-top:20px" type="submit"><i
										class="picons-thin-icon-thin-0154_ok_successful_check"></i></button>
							</div>
						</div>

					</div>
					<hr>
					<?php echo form_close();?>
					<?php if($class_id != "" && $section_id != "" && $student_id != "" && $exam_id != ""):?>
					<!-- experimental if else -->

					<?php if($exam_id == "All"):?>

					<!-- result start -->
					<div class="rcard-table element-box">
						<div class="container">
							<div class="row">
								<div class="col-sm-12 col-md-12 text-center">
									<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
									<div class="rcard-logo-w">
										<img class="img-circle" width="200" height="200" alt=""
											src="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>">
									</div>
									<div class="company-name">
										<h4><?php echo $system_name;?></h4>
									</div>
									<h6><?php echo get_phrase('Progress Report   ');?>(<span><?php echo $running_year?></span>)
									</h6>
									<div class="company-address"></div>
									<h5><u><?php echo get_phrase('Final Marksheet');?></u>
									</h5>
									<br></br>
								</div>
								<div class="col-sm-12 col-md-10 col-lg-10">
									<div class="row">
										<div class="col-sm-12 col-md-6 col-lg-6 company-name">
											<div class="row">
												<h6 class="col-sm-12 col-md-6 col-lg-6"><?php echo get_phrase('Name');?>:
												</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->crud_model->get_name('student', $student_id);?></label>

												<h6 class="col-sm-12 col-md-6 col-lg-6">
													<?php echo get_phrase('Father Name');?>:</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->first_name." ".$this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->last_name;?></label>
											</div>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-6 company-name">
											<div class="row">
												<h6 class="col-sm-12 col-md-6 col-lg-6"><?php echo get_phrase('Roll');?>:
												</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll;?></label>

												<h6 class="col-sm-12 col-md-6 col-lg-6"><?php echo get_phrase('Class');?>:
												</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?>(<span><?php echo $this->db->get_where('section' , array('class_id' => $class_id))->row()->name;?>)</span></label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-2 col-lg-2 img-circle">
									<img class="img-circle" width="100" height="100" alt=""
										src="<?php echo $this->crud_model->get_image_url('student', $student_id);?>">
								</div>
							</div>
							<br></br>
							<div class="col-sm-12 col-lg-12">
								<div class="rcard-table table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th class="text-center"><?php echo get_phrase('subject');?></th>
												<?php 
													$exam = $this->db->get('exam')->result_array();
													foreach($exam as $row):
												?>
        										<th class="text-center"><?php echo $row['name'];?></th>
												<th class="text-center"><?php echo get_phrase('Grade');?></th>
        										<?php endforeach;?>
												<th class="text-center"><?php echo get_phrase('Total');?></th>
											</tr>
										</thead>
										<tbody>
											<?php 	
													$i=0;
													$total_marks_array = array();
													$total_exams_marks = array();
													$total_marks_array1 = array();
													$total_exams_marks1 = array();
													$exams = $this->crud_model->get_exams();
													// Diptesh
													$tests = $this->db->query("SELECT COUNT(DISTINCT (exam_id)) FROM `exam` WHERE 1");
													$exam_names= $this->db->get('exam')->result_array();
													$subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();

													foreach ($subjects as $row3):
														$i= $i+1;
												?>
											<tr class="text-center" id="student-<?php echo $row3['name'];?>">
												<td class="text-center">
 													<?php echo $row3['name'];?></td>
												<?php
												$exam_names= $this->db->get('exam')->result_array();
												foreach ($exam_names as $exm):
													$marks = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exm['exam_id'], 'student_id'=> $student_id,'year' => $running_year))->row()->labtotal;
													$total_marks = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exm['exam_id'], 'student_id'=> $student_id,'year' => $running_year))->row()->mark_total; 												
													array_push($total_exams_marks, $marks);
													array_push($total_marks_array, $total_marks);
													$sub_id = $row3['subject_id'];
													$query = $this->db->query("SELECT grade_point FROM `grade` WHERE $marks >= mark_from and $marks <= mark_upto")->row();
													$session_total = $this->db->query("SELECT SUM(labtotal) FROM `mark` WHERE `student_id`= $student_id AND `subject_id`= $sub_id AND `year`= '$running_year'")->row();

													foreach ($session_total as $total):
												?>
												<td class="text-center">
													<?php echo ($marks."/".$total_marks);?>
												</td>
												<td class="text-center"><?php echo $query-> grade_point?></td>
												<?php endforeach;?>
												

												<?php endforeach;?>
										
												<td class="text-center"><?php echo $total ?></td>
													<?php endforeach;?>
											</tr>
										</tbody>

										<thead>
											<tr>
												<td class="text-center"><?php echo get_phrase('Total');?></td>
												<?php 
												$exam_names= $this->db->get('exam')->result_array();
												foreach ($exam_names as $exm):
													$marks1 = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exm['exam_id'], 'student_id'=> $student_id,'year' => $running_year))->row()->labtotal;
													$total_marks1 = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exm['exam_id'], 'student_id'=> $student_id,'year' => $running_year))->row()->mark_total; 												
													array_push($total_exams_marks1, $marks1);
													array_push($total_marks_array1, $total_marks1);
													$exam_id = $exm['exam_id'];
													$query1 = $this->db->query("SELECT SUM(labtotal) FROM `mark` WHERE `student_id`=$student_id AND `class_id`=1 AND`exam_id`=$exam_id AND `year`= '$running_year'")->row();
													$query2 = $this->db->query("SELECT SUM(mark_total) FROM `mark` WHERE `student_id`=$student_id AND `class_id`=1 AND`exam_id`=$exam_id AND `year`= '$running_year'")->row();
													foreach ($query1 as $markz1):
														foreach ($query2 as $markz2):
												?>
												
												<td class="text-center"><?php echo ($markz1."/".$markz2);?></td>
												<?$percentage = (($markz1/$markz2)*100);?>
												<td class="text-center"><?php echo $percentage; ?></td>
												<?php endforeach;endforeach;endforeach;?>
											</tr>
										</thead>
									</table>
								</div>
							</div>
							<br></br>
							<div class="table table-responsive">
								<h6 class="text-center "><?php echo get_phrase('Grade level');?></h6>
							</div>
							<div>
								<div class="rcard-table table-responsive">
									<table class="table ">
										<thead>
											<tr>
												<th class="text-center"><?php echo get_phrase('Grade scale');?></th>
												<th class="text-center"><?php echo get_phrase('Grade');?></th>
												<th class="text-center"><?php echo get_phrase('Performance Indicator');?>
												</th>
											</tr>
										</thead>
										<?php 
												$grades = $this->db->get('grade')->result_array();
												foreach($grades as $row):
											?>
										<tr>
											<td class="text-center">
												<?php echo $row['mark_from'];?>-<?php echo $row['mark_upto'];?></td>
											<td class="text-center"><?php echo $row['grade_point'];?></td>
											<td class="text-center"><?php echo $row['name'];?></td>
										</tr>
										<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php endif;?>
					<!-- result stop -->
					<?php echo form_close();?>
					<?php if($exam_id != "All"):?>

					<!-- result start -->
					<div class="rcard-table element-box">
						<div class="container">
							<div class="row">
								<div class="col-sm-12 col-md-12 text-center">
									<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
									<div class="rcard-logo-w">
										<img class="img-circle" width="200" height="200" alt=""
											src="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>">
									</div>
									<div class="company-name">
										<h4><?php echo $system_name;?></h4>
									</div>
									<h6><?php echo get_phrase('Progress Report   ');?>(<span><?php echo $running_year?></span>)
									</h6>
									<div class="company-address"></div>
									<h5><u><?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;?></u>
									</h5>
									<br></br>
								</div>
								<div class="col-sm-12 col-md-10 col-lg-10">
									<div class="row">
										<div class="col-sm-12 col-md-6 col-lg-6 company-name">
											<div class="row">
												<h6 class="col-sm-12 col-md-6 col-lg-6"><?php echo get_phrase('Name');?>:
												</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->crud_model->get_name('student', $student_id);?></label>

												<h6 class="col-sm-12 col-md-6 col-lg-6">
													<?php echo get_phrase('Father Name');?>:</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->first_name." ".$this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->last_name;?></label>
											</div>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-6 company-name">
											<div class="row">
												<h6 class="col-sm-12 col-md-6 col-lg-6"><?php echo get_phrase('Roll');?>:
												</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll;?></label>

												<h6 class="col-sm-12 col-md-6 col-lg-6"><?php echo get_phrase('Class');?>:
												</h6>
												<label
													class="col-sm-12 col-md-6 col-lg-6"><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?>(<span><?php echo $this->db->get_where('section' , array('class_id' => $class_id))->row()->name;?>)</span></label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-2 col-lg-2 img-circle">
									<img class="img-circle" width="100" height="100" alt=""
										src="<?php echo $this->crud_model->get_image_url('student', $student_id);?>">
								</div>
							</div>
							<br></br>
							<div class="col-sm-12 col-lg-12">
								<div class="rcard-table table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th class="text-center"><?php echo get_phrase('subject');?></th>
												<th class="text-center"><?php echo get_phrase('mark');?></th>
												<th class="text-center"><?php echo get_phrase('Total');?></th>
												<th class="text-center"><?php echo get_phrase('Grade');?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
								$total_marks_array = array();
								$total_exams_marks = array();
								$exams = $this->crud_model->get_exams();
								// Diptesh
								$tests = $this->db->query("SELECT COUNT(DISTINCT (exam_id)) FROM `exam` WHERE 1");
								$exam_names= $this->db->get('exam')->result_array();
								// foreach ($exam_names as $exm):

								$subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
								foreach ($subjects as $row3):
								$total_marks = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id'=> $student_id,'year' => $running_year))->row()->mark_total; 												
								$marks = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id'=> $student_id,'year' => $running_year))->row()->labtotal;
								array_push($total_exams_marks, $marks);
								array_push($total_marks_array, $total_marks);
								$query = $this->db->query("SELECT grade_point FROM `grade` WHERE $marks >= mark_from and $marks <= mark_upto");
								foreach ($query ->result() as $grade):
									
											?>
											<tr>
												<td><?php echo get_phrase($row3['name']);?>
												</td>
												<td class="text-center">
													<?echo $marks?>
												</td>
												<td class="text-center"><?php echo $total_marks ?></td>
												<td class="text-center"><?php echo $grade -> grade_point ;?></td>
												</tr>
												<?php endforeach; endforeach;?>

										</tbody>

										<thead>
											<tr>
												<td class="text-center"><?php echo get_phrase('Total');?></td>
												<td class="text-center"><?php echo array_sum($total_exams_marks);?></td>
												<td class="text-center"><?php echo array_sum($total_marks_array);?></td>
												<?$percentage = ((array_sum($total_exams_marks)/array_sum($total_marks_array))*100);?>
												<td class="text-center"><?php echo $percentage."%";?></td>
											</tr>
										</thead>
									</table>
								</div>
							</div>
							<br></br>
							<div class="table table-responsive">
								<h6 class="text-center "><?php echo get_phrase('Grade level');?></h6>
							</div>
							<div>
								<div class="rcard-table table-responsive">
									<table class="table ">
										<thead>
											<tr>
												<th class="text-center"><?php echo get_phrase('Grade scale');?></th>
												<th class="text-center"><?php echo get_phrase('Grade');?></th>
												<th class="text-center"><?php echo get_phrase('Performance Indicator');?>
												</th>
											</tr>
										</thead>
										<?php 
							$grades = $this->db->get('grade')->result_array();
							foreach($grades as $row):
										?>
										<tr>
											<td class="text-center">
												<?php echo $row['mark_from'];?>-<?php echo $row['mark_upto'];?></td>
											<td class="text-center"><?php echo $row['grade_point'];?></td>
											<td class="text-center"><?php echo $row['name'];?></td>
										</tr>
										<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php endif;?>
					<!-- result stop -->
				</div>
			</div>
			<?php endif;?>

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
				url: '<?php echo base_url();?>admin/get_class_students/' + section_id,
				success: function (response) {
					jQuery('#student_holder').html(response);
				}
			});
		}
	</script>