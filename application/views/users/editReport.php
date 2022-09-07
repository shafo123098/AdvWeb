<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('users/updateReport'); ?>
    <input type="hidden" name="id" value="<?php echo $report[0]['id']; ?>">
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" id="description" value="<?php echo $report[0]['description'] ?>" required>
    </div>
    
    <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>