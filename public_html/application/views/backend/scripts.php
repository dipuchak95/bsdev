    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>style/js/picker.js"></script>
        <script src="<?php echo base_url();?>style/js/picker.en.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            donetext: 'Done'
        });
    </script>
<?php if ($this->session->flashdata('flash_message') != ""):?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
            }); 
            Toast.fire({
            type: 'success',
            title: '<?php echo $this->session->flashdata("flash_message");?>'
            })
        </script>
    <?php endif;?>
    
     <script>
    $(document).ready(function() {
        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }else{
			
		}
		// btn click
		$('#return_book_btn').click(function(){
			bookReturn();
			//console.log("return clicked");
		});
		$('#add_fees_structure_btn').click(function(){
			addFeesStructure(); 
			console.log("fees structure clicked");
		});
    });
    </script>

    <script type="text/javascript">
        function validatestudent()
        {
            var studentid= $('#student_id').val().trim();
             $.ajax({
                 url: '<?= base_url('set-student')?>',
                 type: 'POST',
                 data: {studentid: studentid},
                 success: function(response){
                       $('#verify-student').html(response);
                    }
                 })
        }

        function getstudent()
        {
            var studentid= $('#student_id').val().trim();
             $.ajax({
                 url: '<?= base_url('get-student')?>',
                 type: 'POST',
                 data: {studentid: studentid},
                 success: function(response){
                       $('#verify-student').html(response);
                    }
                 })

        }
		function getbarcode()
		{
			var barcode= $('#barcode').val().trim();
			$.ajax({
                 url: '<?= base_url('get-student')?>',
                 type: 'POST',
                 data: {studentid: studentid},
                 success: function(response){
                       $('#verify-student').html(response);
                    }
                 })
		}
    </script>
    <script type="text/javascript">
        function validatebarcode()
        {
            var barcode= $('#barcode').val().trim();
             $.ajax({
                 url: '<?= base_url('set-barcode')?>',
                 type: 'POST',
                 data: {barcode: barcode},
                 success: function(response){
                       $('#verify-barcode').html(response);
                    }
                 })
        }

        function bookissue()
        {
            var studentid= $('#student_id').val().trim();
            var barcode= $('#barcode').val().trim();
            var issuedate = $("#datetimepicker").val().trim();
            var returndate = $("#datetimepicker1").val().trim();
            $.ajax({
                 url: '<?= base_url('book-issue')?>',
                 type: 'POST',
                 data: {studentid: studentid,barcode : barcode, issuedate : issuedate,returndate : returndate},
                 success: function(responses){
                    var respond = JSON.parse(responses);
                    if(respond.status == 1){
                      console.log(respond.status)
                      const Toast = Swal.mixin({
                         toast: true,
                         position: 'top-end',
                         showConfirmButton: false,
                         timer: 8000
                        }); 
                        Toast.fire({
                        type: 'success',
                         title: 'Book Issued Successfully'
                            })
                     setTimeout(function(){ location.reload(); }, 2000);
                    }else{
                        console.log(respond.status);
                        const Toast = Swal.mixin({
                         toast: true,
                         position: 'top-end',
                         showConfirmButton: false,
                         timer: 8000
                        }); 
                        Toast.fire({
                        type: 'error',
                         title: 'Same Book Already issued'
                            })
                       setTimeout(function(){ location.reload(); }, 2000);

                    }               
                }
        });
        }
		function bookReturn()
        {
            var studentid= $('#student_id').val().trim();
            var barcode= $('#barcode').val().trim();
            var returndate = $("#returnDate").val().trim();
			console.log(studentid+barcode+returndate);
            $.ajax({
                 url: '<?= base_url('retrn-book')?>',
                 type: 'POST',
                 data: {studentid:studentid, barcode:barcode, returndate:returndate},
                 success: function(responses){
                    var respond = JSON.parse(responses);
                    if(respond.status == 3){
                      console.log(respond.status)
                      const Toast = Swal.mixin({
                         toast: true,  
                         position: 'top-end',
                         showConfirmButton: false,
                         timer: 8000
                        }); 
                        Toast.fire({
                        type: 'success',
                         title: 'Book Return Successfully'
                            })
                     setTimeout(function(){ location.reload(); }, 2000);
                    }else{
                        console.log(respond.status);
                        const Toast = Swal.mixin({
                         toast: true,
                         position: 'top-end',
                         showConfirmButton: false,
                         timer: 8000
                        }); 
                        Toast.fire({
                        type: 'error',
                         title: 'This book already returned'
                            })
                       setTimeout(function(){ location.reload(); }, 2000);

                    }               
                }
        });
        }
		
		//fees structure addition
		
		
		function addFeesStructure()
        {
			console.log("Add Fees Structure fuction called");
            var classid= $('#class_id option:selected').val();
            var typeid= $('#type_id').val();
			var amount =$('#amount').val();
			var month_id =$('#month_id').val(); 
            var last_submsn_date = $("#last_submsn_date").val();
			console.log(classid+"type==="+typeid+"amount==="+amount+"month==="+month_id+"submsn==="+last_submsn_date);
            $.ajax({
                 url: '<?= base_url('add-fees-insert')?>',
                 type: 'POST',
                 data: {classid:classid, typeid:typeid, amount:amount, month_id:month_id, last_submsn_date:last_submsn_date},
                 success: function(responses){
                    var respond = JSON.parse(responses);
                    if(respond.class_id == classid){
                      const Toast = Swal.mixin({
                        toast: true,  
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                        }); 
                        Toast.fire({
                        type: 'success',
                        title: 'Successful added'
                        })
                     setTimeout(function(){ location.reload(); }, 2000);
                    }else{
                        console.log(respond.status);
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                        }); 
                        Toast.fire({
                        type: 'error',
                        title: 'Failed'
                        })
                       setTimeout(function(){ location.reload(); }, 2000);

                    }               
                }
        });
        }


        function addConcession()
        {
			// console.log("Add Concession fuction called");
            var class_id= $('#class_id option:selected').val().trim();
            var section= $('#section_holder option:selected').text().trim();
			var student =$('#student_holder option:selected').text().trim();
			var running_year =$('#running_year_id option:selected').text().trim(); 
            var from_month =$('#from_month_id option:selected').text().trim();
            var to_month =$('#to_month_id option:selected').text().trim();
            var amount = $('#amount').val().trim();
			// console.log("class: "+class_id+"//section: "+section+"//student: "+student+"//year: "+running_year+"//f_month: "+from_month+"//to_month: "+to_month+"//amount: "+amount);
           
            $.ajax({
                 url: '<?= base_url('add-concession-data')?>',
                 type: 'POST',
                 data: {class_id:class_id, section:section, student:student, running_year:running_year, from_month:from_month, to_month:to_month, amount:amount },
                //  dataType: 'json',
                 success: function(responses){
                    var respond = JSON.parse(responses);
                    if(respond.class_id == class_id){
                        // console.log("swal")
                      const Toast = Swal.mixin({
                        toast: true,  
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                        }); 
                        Toast.fire({
                        type: 'success',
                        title: 'Successful added'
                        })
                     setTimeout(function(){ location.reload(); }, 2000);
                    }else{
                        console.log(respond.status);
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                        }); 
                        Toast.fire({
                        type: 'error',
                        title: 'Failed'
                        })
                       setTimeout(function(){ location.reload(); }, 2000);

                    }               
                }
            });
        }

        function addDiscount()
        {
			// console.log("Add Concession fuction called");
            var class_id= $('#class_id option:selected').val().trim();
            var section= $('#section_holder option:selected').text().trim();
			var student =$('#student_holder option:selected').text().trim();
			var running_year =$('#running_year_id option:selected').text().trim(); 
            var month =$('#month_id option:selected').text().trim();
            var amount = $('#amount').val().trim();
			// console.log("class: "+class_id+"//section: "+section+"//student: "+student+"//year: "+running_year+"//f_month: "+from_month+"//to_month: "+to_month+"//amount: "+amount);
           
            $.ajax({
                 url: '<?= base_url('add-discount-data')?>',
                 type: 'POST',
                 data: {class_id:class_id, section:section, student:student, running_year:running_year, month:month, amount:amount },
                //  dataType: 'json',
                 success: function(responses){
                    var respond = JSON.parse(responses);
                    if(respond.class_id == class_id){
                        // console.log("swal")
                      const Toast = Swal.mixin({
                        toast: true,  
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                        }); 
                        Toast.fire({
                        type: 'success',
                        title: 'Successful added'
                        })
                     setTimeout(function(){ location.reload(); }, 2000);
                    }else{
                        console.log(respond.status);
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000
                        }); 
                        Toast.fire({
                        type: 'error',
                        title: 'Failed'
                        })
                       setTimeout(function(){ location.reload(); }, 2000);

                    }               
                }
            });
        }
    </script>

    <script src="<?php echo base_url();?>style/cms/bower_components/jquery/dist/jquery.min.js"></script>
    <script src='<?php echo base_url();?>style/fullcalendar/js/jquery.js'></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/moment/moment.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/dropzone/dist/dropzone.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/util.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="<?php echo base_url();?>style/cms/js/main.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/dragula.js/dist/dragula.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/modal.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>style/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/slick-carousel/slick/slick.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/alert.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/button.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/carousel.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/collapse.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/dropdown.js"></script>
    <script src="<?php echo base_url();?>assets/js/ajax-form-submission.js"></script>
    <script src='<?php echo base_url();?>style/fullcalendar/js/fullcalendar.min.js'></script>
    <script src="<?php echo base_url();?>style/olapp/js/jquery.appear.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/jquery.matchHeight.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/svgxuse.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/Headroom.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/velocity.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/ScrollMagic.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/jquery.waypoints.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/jquery.countTo.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/material.min.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/bootstrap-select.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/smooth-scroll.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/selectize.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/swiper.jquery.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/moment.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/isotope.pkgd.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/circle-progress.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/loader.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/sticky-sidebar.js"></script>
    <script src="<?php echo base_url();?>style/olapp/js/base-init.js"></script>
    <script defer src="<?php echo base_url();?>style/olapp/fonts/fontawesome-all.js"></script>
    <script src="<?php echo base_url();?>style/olapp/Bootstrap/dist/js/bootstrap.bundle.js"></script>