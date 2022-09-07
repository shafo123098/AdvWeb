<div id="home">
  <h1>Home Page</h1>
  <p>This is home page</p>
</div>

<div id="contact">
  <h1>Contact Page</h1>
  <p>This is contact page</p>
</div>

<div id="about">
  <h1>About Page</h1>
  <p>This is about page</p>
</div>


<div id="register">
  <h1>Register</h1>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('users/register'); ?>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" required>
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
</div>

<a href="#" id="top" class="btn btn-secondary">Back to Top &#8593;</a>