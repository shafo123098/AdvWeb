<h2><?= $title ?></h2>
<div class="container" id="viewDiv" style="border-style:solid;width:70%;float:left;border-radius:10px;border-width:0px;background-color:#ededed;padding:20px">
    <img src="<?php echo base_url() ?>/assets/img/user.png" width="170px" height="170px" style="float: right;">

    <p><strong> Name : </strong><?php echo $user[0]['first_name'] ?> <?php echo $user[0]['last_name']; ?></p>
    <p><strong> Email Address : </strong><?php echo $user[0]['email_address']; ?></p>
    <p><strong> Username : </strong><?php echo $user[0]['username']; ?></p>
    <p><strong> Registered At : </strong><?php echo $user[0]['registered_at']; ?></p>
    <p><strong> Roles : </strong><?php foreach ($roles as $role) : ?>
    <p> - <?php echo $role['role']; ?>
     <?php if(!empty($role['role'])) : ?>
        <?php echo form_open('/users/deleteUserRole/'); ?>
                <!-- <a type="submit" class="link-danger">delete</a> -->
                <input type="submit" value="Delete" class="btn btn-danger">
                <input type="hidden" name="role_id" value="<?php echo $role['id']; ?>"/>
                <input type="hidden" name="user_id" value="<?php echo $user[0]['id']; ?>"/>
            </form>
    <?php endif;?>
        <?php endforeach; ?></p></p>
       
<hr>
<hr>
<a class="btn btn-primary pull-left" style="margin-bottom: 10; width:73px" href="/users/editLoggedInUser/<?php echo $user[0]['id']; ?>">Edit</a>
<?php echo form_open('/users/deleteUser/' . $user[0]['id']); ?>
<input type="submit" style="margin-left: 5px;" value="Delete" class="btn btn-danger">
</form>

</div>