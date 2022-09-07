<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('users/updateLoggedInUser'); ?>
    <input type="hidden" name="id" value="<?php echo $user[0]['id']; ?>">
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $user[0]['first_name']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $user[0]['last_name']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo $user[0]['username']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="email_address" class="form-label">Email Address</label>
        <input type="email" class="form-control" name="email_address" id="email_address" value="<?php echo $user[0]['email_address']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="zipcode" class="form-label">ZipCode</label>
        <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $user[0]['zipcode']; ?>" required>
    </div>
    <?php
    if ($this->session->userdata('username') == $user[0]['username']) {

     echo
    '<div class="mb-3">
        <label for="oldPassword" class="form-label">Old Password</label>
        <input type="password" class="form-control" name="old_password" id="old_password" required>
    </div>';
    }
    ?>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <div class="mb-3">
        <label for="password2" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="password2" id="password2" required>
    </div>


    <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>