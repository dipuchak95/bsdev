<?php

if($barcodedetails){
	?>
<h6 class="title">Book Details</h6>
<hr></hr>
	
   <div class="row">									
	<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Book Name</label>
		    <input class="form-control" name="book_name" value="<?= $barcodedetails[0]->name ?>" type="text" required="">
	    </div>
    </div>	
	<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Author</label>
		    <input class="form-control" name="author" value="<?= $barcodedetails[0]->author ?>" type="text" required="">
	    </div>
    </div>												
	
	<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Class</label>
		    <input class="form-control" name="class_er"  type="text" required="">
	    </div>
    </div>												
	<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	    <div class="form-group label-floating">
			<label class="control-label">Barcode</label>
		    <input class="form-control" name="barcode" value="<?=  $barcodedetails[0]->barcode?>" type="text" required="">
	    </div>
    </div>
</div>


	<?php
}else
{
	echo "no result found for barcode";
}
?>


