<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Users</h4>
<!-- <div style="width: 40%;float:left"> -->
<?php echo form_open('/users/getUserByName/'); ?>
<input class="form-control me-2" type="search" name="searchUser" placeholder="Search User Here" aria-label="Search" style="width: 40%;float:left">
<button class="btn btn-outline-primary" type="submit">Search</button>
</form>

<a class="btn btn-primary" href="<?php echo base_url('/users/register'); ?>" style="float: right;margin-bottom:10px">+ Add new User</a>

<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
<thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Name</th>
        <th style="font-size: 20px;font-weight: bold;">Email Address</th>
        <th style="font-size: 20px;font-weight: bold;">Username</th>
        <th style="font-size: 20px;font-weight: bold;">Role</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>

    </tr>
    </thead>
    <?php $count = 1;
    foreach ($users as $user) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo $user['first_name'] ?> <?php echo $user['last_name']; ?></td>
            <td><?php echo $user['email_address']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <?php if($user['role_status'] == 'Not Assigned' || empty($userRoles)) : ?>
            <td><a href="<?php echo base_url('/users/addUserRole/'. $user['id']); ?>" class="link-danger"><?php echo $user['role_status']; ?></a></td>
            <?php elseif($user['role_status'] == 'Assigned') : ?>
                <td><?php foreach ($userRoles as $userRole) : ?>
                        <?php if($user['id']==$userRole['user_id']) : ?>
                            <a href="<?php echo base_url('/users/addUserRole/'. $user['id']); ?>" class="link-success"><?php echo $userRole['role']; ?></a><br><br>
                        <?php endif; ?>
                    <?php endforeach;?>
                </td>
                <?php endif; ?>
            <td>
                <?php echo form_open('/users/viewUser/' . $user['id']); ?>
                <input type="submit" value="Read More" class="btn btn-secondary">
                </form>
            </td>
        </tr>
    <?php $count++;
    endforeach; ?>

</table>
</div>
<div class="pagination-links" style="margin: 30px;display:flex;justify-content:center;">
    <?php echo $this->pagination->create_links(); ?>
</div>