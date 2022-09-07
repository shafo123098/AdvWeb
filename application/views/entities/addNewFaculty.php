<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/addFaculty'); ?>
    <form name="form">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" id="name" require>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="name" require>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="number" class="form-control" name="contact" id="contact" require>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" require>
        </div>
        <div class="mb-3">
            <label for="email_address" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email_address" id="email_address" require>
        </div>
        <button style="margin-top: 30px;" onclick="allLetter()" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>