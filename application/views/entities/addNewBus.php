<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/addBus'); ?>
    <div class="mb-3">
        <label for="registration_no" class="form-label">Registration No</label>
        <input type="text" class="form-control" name="registration_no" id="registration_no">
    </div>
    <p><strong>Type : </strong></p>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="type" value="Private" checked>
        <label class="form-check-label" for="type">
            Private
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="type" value="Government">
        <label class="form-check-label" for="type">
            Government
        </label>
    </div>
    <input type="hidden" name="assign_status" id="type" value="Not Assigned">
    <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>