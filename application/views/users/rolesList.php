<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Roles</h4>


<a class="btn btn-primary" href="<?php echo base_url('/users/addRole'); ?>" style="float: right;margin-bottom:10px">+ Add new Role</a>
<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
<thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Role</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>
    </tr>
    </thead>
    <?php $count = 1;
    foreach ($roles as $role) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo $role['role'] ?></td>
            <td>
                    <a class="btn btn-primary pull-left" style="float:left;margin-right: 20px;width:73px" href="/users/editRole/<?php echo $role['id']; ?>">Edit</a>

                    <?php echo form_open('/users/deleteRole/' . $role['id']); ?>
                    <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
        </tr>
    <?php $count++;
    endforeach; ?>

</table>
</div>