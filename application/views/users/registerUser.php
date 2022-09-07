<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('users/register'); ?>
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>
    <div class="mb-3">
        <label for="email_address" class="form-label">Email Address</label>
        <input type="email" class="form-control" name="email_address" id="email_address" required>
    </div>
    <div class="mb-3">
        <label for="zipcode" class="form-label">ZipCode</label>
        <input type="text" class="form-control" name="zipcode" id="zipcode" required>
    </div>
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