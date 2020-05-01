  <div class="element-wrapper">
                <h6 class="element-header">
                  <?php echo get_phrase('books');?> 
                 
                </h6>
                <div class="element-box-tp">
                	 <?php
                 	if($details){
                 		?>
                 	
                  <div class="table-responsive">
                    <table class="table table-padded">
                      <thead>
                        <tr>
                        	<th><?php echo get_phrase('SL.NO');?></th>
                            <th><?php echo get_phrase('name');?></th>
				            <th><?php echo get_phrase('class');?></th>
            				<th><?php echo get_phrase('book');?></th>
				            <th><?php echo get_phrase('issue_date');?></th>
				            <th><?php echo get_phrase('issue_end_date');?></th>
			            </tr>
                      </thead>
                      <tbody>
                     <tr>
                     	<?php
                     		$this->db->select('*');
                     		$this->db->from('student');
                     		$this->db->where('student_id',$details[0]->student_id);
                     		$studentname = $this->db->get()->result();
                     		$this->db->select('*');
                     		$this->db->from('class');
                     		$this->db->where('class_id',$studentname[0]->class_id);
                     		$class = $this->db->get()->result();
                     		$this->db->select('*');
                     		$this->db->from('book');
                     		$this->db->where('book_id',$details[0]->book_id);
                     		$book_name = $this->db->get()->result();
                     	   foreach ($details as $key => $value) {

                     	   ?>
                     	   <td><?= $key+1 ?></td>
				          <td><?= $studentname[0]->first_name." ".$studentname[0]->last_name ?>
				          </td>
				          <td><?php if($class[0]->name)
				          {
				          	echo $class[0]->name;
				          }else
				          {
				          	echo "no class assigned yet";
				          } ?></td>
				          <td><?= $book_name[0]->name ?></td>
				          <td><?php echo date('d-m-Y', strtotime($value->issue_start_date));?></td>
				          <td><?php echo date('d-m-Y', strtotime($value->issue_end_date));?></td> 

                     	   <?php
                     	   }
                     	   ?>
				      
			        </tr>
                    </tbody>
                    </table>
                  </div>
                  <?php
              }else
              {
              	echo "No student";
              }
              ?>
                </div>
  </div>