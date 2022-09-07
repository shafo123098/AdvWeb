<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/updateStudent'); ?>
    <input type="hidden" name="id" value="<?php echo $student[0]['id']; ?>">
    <div class="mb-3">

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $student[0]['first_name']; ?>">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $student[0]['last_name']; ?>">
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" name="age" id="age" value="<?php echo $student[0]['age']; ?>">
        </div>
        <div class="mb-3">
            <label for="email_address" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email_address" id="email_address" value="<?php echo $student[0]['email_address']; ?>" aria-describedby="emailHelp">
        </div>
        <div class="mb-4">
            <label for="roll_no" class="form-label">Roll No.</label>
            <input type="text" class="form-control" name="roll_no" id="roll_no" value="<?php echo $student[0]['roll_no']; ?>" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" value="<?php echo $student[0]['address']; ?>" aria-describedby="emailHelp">
        </div>
        <strong>Gender : </strong>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" checked>
            <label class="form-check-label" for="gender">
                Male
            </label>
        </div>
        <div class="form-check" style="margin-bottom: 30px;">
            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
            <label class="form-check-label" for="gender">
                Female
            </label>
        </div>

        <p><strong>Current Route : </strong><?php echo $route[0]['route_name']; ?> # <?php echo $route[0]['route_no']; ?></p>
        <select class="form-select" name="route_id" aria-label="Default select example" style="margin-top:25px;margin-bottom:25px" required>
            <?php foreach ($routes as $route) : ?>
                <option value=<?php echo $route['id']; ?>><?php echo $route['route_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>