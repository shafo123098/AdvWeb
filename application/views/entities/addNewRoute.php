<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/addRoute'); ?>
    <div class="mb-3">
        <label for="route_name" class="form-label">Route Name</label>
        <input type="text" class="form-control" name="route_name" id="route_name">
    </div>
    <div class="mb-3">
        <label for="route_no" class="form-label">Route No #</label>
        <input type="number" class="form-control" name="route_no" id="route_name">
    </div>
    <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>