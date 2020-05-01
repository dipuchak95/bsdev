<?php

if($studentdetails)
{
	?>
<div class="ui-block-title" style="margin-bottom:10px;">
    	<h6 class="title">Student Details</h6>
</div>
<hr></hr>
<div class="row">									
  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Student Name</label>
		    <input class="form-control" name="student_name" type="text" value="<?= $studentdetails[0]->first_name." ".$studentdetails[0]->last_name ?>"required="" disabled="">
	    </div>
    </div>	
	<div class="col col-lg-3 col-md-3 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Class</label>
		    <input class="form-control" name="student_class" type="text" value="<?php
		     $this->db->select('*');
		     $this->db->from('class');
		     $this->db->where('class_id',$studentdetails[0]->class_id);
		     $class = $this->db->get()->result();
		     if($class)
		     {
		     	echo $class[0]->name;
		     }else
		     {
		     	echo "no class is alloted yet";
		     }


		    ?>" required="" disabled="">
	    </div>
    </div>												
	
	<div class="col col-lg-3 col-md-3 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Section</label>
		    <input class="form-control" name="student_rollno" value="<?php
		     $this->db->select('*');
		     $this->db->from('section');
		     $this->db->where('class_id',$studentdetails[0]->class_id);
		     $section = $this->db->get()->result();
		     if($section)
		     {
		     	echo $section[0]->name;
		     }else
		     {
		     	echo "no section is alloted yet";
		     }


		    ?>" type="text" required="" disabled="">
	    </div>
    </div>	
    <div class="col col-lg-3 col-md-3 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Roll no</label>
		    <input class="form-control" name="student_rollno" value="<?php
		     $this->db->select('*');
		     $this->db->from('enroll');
		     $this->db->where('class_id',$studentdetails[0]->class_id);
		     $roll = $this->db->get()->result();
		     if($roll)
		     {
		     	echo $roll[0]->roll;
		     }else
		     {
		     	echo "no roll is alloted yet";
		     }


		    ?>" type="text" required="" disabled="">
	    </div>
    </div>
      <div class="col col-lg-3 col-md-3 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Year</label>
		    <input class="form-control" name="student_rollno" value="<?php
		     $this->db->select('*');
		     $this->db->from('enroll');
		     $this->db->where('class_id',$studentdetails[0]->class_id);
		     $year = $this->db->get()->result();
		     if($year)
		     {
		     	echo $year[0]->year;
		     }else
		     {
		     	echo "no year is alloted yet";
		     }


		    ?>" type="text" required="" disabled="">
	    </div>
    </div>													
	<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Return date</label>
		    <input class="form-control" name="book_returndate" type="text" required="">
	    </div>
    </div>
	<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Contact no</label>
		    <input class="form-control" name="student_contact_no" value="<?= $studentdetails[0]->phone  ?>" type="text" required="" disabled="">
	    </div>
    </div>	
</div>
<?php
}else
{
	echo "no result found for student details";
}
?>
