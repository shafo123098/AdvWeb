<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/addBusRoute'); ?>

    <p style="margin-top:20px"><strong>Assign Bus</strong></p>
    <select class="form-select" name="bus_id" aria-label="Default select example" style="margin-top:25px;margin-bottom:25px" required>
        <?php foreach ($buses as $bus) : ?>
            <option value=<?php echo $bus['id']; ?>><?php echo $bus['registration_no']; ?></option>
        <?php endforeach; ?>
    </select>
    <p style="margin-top:20px"><strong>Assign Route</strong></p>
    <select class="form-select" name="route_id" aria-label="Default select example" style="margin-top:25px;margin-bottom:25px" required>
        <?php foreach ($routes as $route) : ?>
            <option value=<?php echo $route['id']; ?>><?php echo $route['route_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <div class="mb-3">
        <label for="registration_no" class="form-label">Time</label>
        <input type="time" class="form-control" name="time" id="time" required>
    </div>
    <div class="mb-3">
        <label for="registration_no" class="form-label">Starting Point</label>
        <input type="text" class="form-control" name="starting_point" id="starting_point" required>
    </div>
    <div class="mb-3">
            <label for="via" class="form-label">Via</label>
            <input type="text" class="form-control" name="via" id="via" required>
        </div>
    <p><strong>Status : </strong></p>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="type" value="Girls" checked>
        <label class="form-check-label" for="type">
            Girls
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="type" value="Boys">
        <label class="form-check-label" for="type">
            Boys
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="type" value="Combine">
        <label class="form-check-label" for="type">
            Combine
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="type" value="Faculty">
        <label class="form-check-label" for="type">
            Staff
        </label>
    </div>
    <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>