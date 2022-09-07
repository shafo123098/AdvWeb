<?php echo form_open('users/login'); ?>
<img src="<?php echo base_url() ?>/assets/img/uog-logo.png" width="150px" height="100px" style="display: block;
  margin-left: auto;
  margin-right: auto;
  margin-bottom:20px;
  margin-top:50px">

<div style="position: fixed;
border-width:2px;
border-style:solid;
border-color:#bfe4ff;
border-radius:20px;
background-color:#e3f2fd;
padding:40px;
width:30%;
left: 35%;
box-shadow: 0px 3px 30px rgba(0, 0, 0, 0.50);">
    <h2 style="text-align: center; color:#32427a;">Login</h2>
    <hr style="width: 100%;">
    <div class="mb-3">
        <input type="text" name="username" placeholder="Enter Username" class="form-control" id="username" required autofocus>
    </div>
    <div class="mb-3">
        <input type="password" name="password" placeholder="Enter Password" class="form-control" id="password" required autofocus>
    </div>
    <div class="form-check" style="margin: 10px;">
        <input type="checkbox" onclick="showPassword()" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Show Password</label>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-outline-primary btn-block">Sign in</button>
    </div>
</div>

<?php echo form_close(); ?>