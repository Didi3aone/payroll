<?php 
    $fullname   = (isset($user['fullname'])) ? $user['fullname'] : ""; 
    $email      = (isset($user['email'])) ? $user['email'] : ""; 
    $username   = (isset($user['username'])) ? $user['username'] : ""; 
    $level      = (isset($user['role_id'])) ? $user['role_id'] : "";
    $id         = (isset($user['id'])) ? $user['id'] : "";
    $photo      = (isset($user['photo'])) ? $user['photo'] : "assets/images/users/1.jpg";
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $title_form; ?></h4>
                <form class="form-material m-t-40" method="POST" id="user-form" action="<?php echo site_url('user/process_form'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">    
                    <div class="form-group">
                        <label>Fullname <span class="help">*</span></label>
                        <input type="text" name="fullname" class="form-control form-control-line" value="<?php echo $fullname; ?>" placeholder="Fullname"> </div>
                    <div class="form-group">
                        <label for="example-email">Email <span class="help">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>"> </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Username"> </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" value=""> </div>
                    <div class="form-group">
                        <label>Password Confirmation</label>
                        <input type="password" class="form-control" name="pass_conf" id="pass_conf" value=""> </div>
                    <div class="form-group">
                        <label>User Level</label>
                        <select style="width: 100%;" name="role_id" id="role_id" class="form-control select2">
                            <option value=""> --choose--</option>
                            <?php echo modules::run('dropdown/UserRole', $level); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Photo</h4>
                                <input type="file" id="input-file-now-custom-1" name="photo" class="dropify" data-default-file="<?= base_url($photo); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10 btn-submit">Submit</button>
                        <a class="btn btn-inverse waves-effect waves-light" href="<?php echo $url_back; ?>">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>