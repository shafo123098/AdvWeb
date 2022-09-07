<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/BusHistoryAdded'); ?>
    <input type="hidden" name="bus_id" id="bus_id" value="<?php echo $bus[0]['id']; ?>" require>

    <form name="form">
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" require>
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" class="form-control" name="cost" id="cost" require>
        </div>
        <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>