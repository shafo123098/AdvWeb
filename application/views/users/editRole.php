<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('users/updateRole'); ?>
    <input type="hidden" name="id" value="<?php echo $role[0]['id']; ?>">
    <div class="mb-3">
        <label for="role_name" class="form-label">Role Name</label>
        <input type="text" class="form-control" name="role_name" id="role_name" value="<?php echo $role[0]['role'] ?>" required>
    </div>
    
    <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>