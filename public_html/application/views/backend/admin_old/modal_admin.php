<?php 
    $admin = $this->db->get_where('admin' , array('admin_id' => $param2))->result_array();
    foreach($admin as $row):
?>
      <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo get_phrase('update_information');?></h6>
        </div>
        <div class="ui-block-content">
              <?php echo form_open(base_url() . 'admin/admins/update/'.$row['admin_id'], array('enctype' => 'multipart/form-data'));?>
                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="form-group">
                                    <label class="control-label"><?php echo get_phrase('photo');?></label>
                                    <input name="userfile" accept="image/x-png,image/gif,image/jpeg" id="imgpre" type="file"/>
                                </div>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo get_phrase('first_name');?></label>
                                    <input class="form-control" type="text" name="first_name" required="" value="<?php echo $row['first_name'];?>">
                                </div>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo get_phrase('last_name');?></label>
                                    <input class="form-control" type="text" required="" name="last_name" value="<?php echo $row['last_name'];?>">
                                </div>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo get_phrase('username');?></label>
                                    <input class="form-control" type="text" name="username" required="" value="<?php echo $row['username'];?>">
                                </div>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo get_phrase('password');?></label>
                                    <input class="form-control" type="text" name="password">
                                </div>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo get_phrase('email');?></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo $row['email'];?>">
                                    <span class="input-group-addon">
                                        <i class="icon-feather-mail"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo get_phrase('account_type');?></label>
                                    <div class="select">
                                        <select name="owner_status" id="slct">
                                            <option value="">Seleccionar</option>
                                            <option value="1" <?php if($row['owner_status'] == 1) echo 'selected';?>><?php echo get_phrase('suer_admin');?></option>
                                            <option value="0" <?php if($row['owner_status'] == 2) echo "selected";?>><?php echo get_phrase('admin');?></option>
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo get_phrase('phone');?></label>
                                    <input class="form-control" placeholder="" name="phone" type="text" value="<?php echo $row['phone'];?>">
                                    <span class="input-group-addon">
                                        <i class="icon-feather-phone"></i>
                                    </span>
                                </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo get_phrase('gender');?></label>
                                    <div class="select">
                                        <select name="gender" id="slct">
                                            <option value=""><?php echo get_phrase('select');?></option>
                                            <option value="M" <?php if($row['gender'] == 'M') echo 'selected';?>><?php echo get_phrase('male');?></option>
                                            <option value="F" <?php if($row['gender'] == 'F') echo 'selected';?>><?php echo get_phrase('female');?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo get_phrase('address');?></label>
                                    <input class="form-control" placeholder="" name="address" type="text" value="<?php echo $row['address'];?>">
                                    <span class="input-group-addon">
                                        <i class="icon-feather-map-pin"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <button class="btn btn-rounded btn-success btn-lg " type="submit"><?php echo get_phrase('update');?></button>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
    <?php endforeach;?>
 