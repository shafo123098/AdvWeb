<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/updateBusHistory'); ?>
    <input type="hidden" name="id" value="<?php echo $busHistory[0]['id']; ?>">
    <div class="mb-3">

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="<?php echo $busHistory[0]['description']; ?>" require>
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" class="form-control" name="cost" id="cost" value="<?php echo $busHistory[0]['cost']; ?>" require>
        </div>
        <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>