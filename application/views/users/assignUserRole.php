<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('users/addUserRole/'.$user[0]['id']); ?>
    <strong>User : </strong><?php echo $user[0]['first_name']; ?> <?php echo $user[0]['last_name']; ?><br><hr>
        <?php foreach($roles as $role) : ?>
            <label for="role" ><?php echo $role['role'];?></label>
            <input type="radio" name="role_id" value = "<?php echo $role['id'];?>" checked /><br />
        <?php endforeach; ?>

    <input style="margin-top: 20px;" type="submit" class="btn btn-primary" value="Save"/>
    </form>
</div>