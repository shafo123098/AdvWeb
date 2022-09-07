<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/updateBus'); ?>
    <input type="hidden" name="id" value="<?php echo $bus[0]['id']; ?>" <div class="mb-3">

    <div class="mb-3">
        <label for="registration_no" class="form-label">Registration No</label>
        <input type="text" class="form-control" name="registration_no" id="registration_no" value="<?php echo strtoupper($bus[0]['registration_no']); ?>">
    </div>
    <p><strong>Current Type : </strong><?php echo $bus[0]['type']; ?></p>
    <div class="mb-2">
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
    <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>