<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/addDriver'); ?>
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name">
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name">
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control" name="age" id="age">
    </div>
    <div class="mb-4">
        <label for="contact" class="form-label">Contact</label>
        <input type="text" class="form-control" name="contact" id="contact" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" id="address" aria-describedby="emailHelp">
    </div>
    <p style="margin-top:20px"><strong>Assign Bus</strong></p>
    <select class="form-select" name="bus_id" aria-label="Default select example" style="margin-top:25px;margin-bottom:25px" required>
        <?php foreach ($buses as $bus) : ?>
            <option value=<?php echo $bus['id']; ?>><?php echo $bus['registration_no']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>