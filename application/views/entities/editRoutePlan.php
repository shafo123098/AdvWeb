<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/updateRoutePlan'); ?>
    <input type="hidden" name="bus_id" value="<?php echo $routePlan[0]['bus_id']; ?>">
    <input type="hidden" name="route_id" value="<?php echo $routePlan[0]['route_id']; ?>">

    <div class="mb-3">

        <!-- <p><strong>Current Route : </strong><?php echo $routePlan[0]['route_name']; ?> # <?php echo $routePlan[0]['route_no']; ?></p>
        <select class="form-select" name="route_id" aria-label="Default select example" style="margin-top:25px;margin-bottom:25px" required>
            <?php foreach ($routes as $route) : ?>
                <option value=<?php echo $route['id']; ?>><?php echo $route['route_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <p><strong>Current Bus : </strong><?php echo strtoupper($routePlan[0]['registration_no']); ?></p>
        <select class="form-select" name="bus_id" aria-label="Default select example" style="margin-top:25px;margin-bottom:25px" required>
            <?php foreach ($buses as $bus) : ?>
                <option value=<?php echo $bus['id']; ?>><?php echo $bus['']; ?></option>
            <?php endforeach; ?>
        </select> -->
        <div class="mb-3">
            <label for="time" class="form-label">Time </label>
            <input type="time" class="form-control" name="time" id="time" value="<?php echo $routePlan[0]['time']; ?>">
        </div>
        <div class="mb-3">
            <label for="starting_point" class="form-label">Starting Point</label>
            <input type="text" class="form-control" name="starting_point" id="starting_point" value="<?php echo $routePlan[0]['starting_point']; ?>">
        </div>
        <div class="mb-3">
            <label for="via" class="form-label">Via</label>
            <input type="text" class="form-control" name="via" id="via" value="<?php echo $routePlan[0]['via']; ?>">
        </div>
        <p><strong>Current Status : </strong><?php echo $routePlan[0]['status']; ?></p>
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
                Faculty
            </label>
        </div>
        <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>