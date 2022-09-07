<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>
<div style="width: 70%;">
    <?php echo form_open('entities/updateFaculty'); ?>
    <form name="form">
        <input type="hidden" name="id" value="<?php echo $faculty[0]['id']; ?>">
        <div class="mb-3">

            <div class="mb-3">
                <label for="name" class="form-label">Fisrt Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $faculty[0]['first_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $faculty[0]['last_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="number" class="form-control" name="contact" id="contact" value="<?php echo $faculty[0]['contact']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="<?php echo $faculty[0]['address']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email_address" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email_address" id="email_address" value="<?php echo $faculty[0]['email_address']; ?>" required>
            </div>
            <button style="margin-top: 30px;" type="submit" onclick="allLetter()" class="btn btn-primary">Submit</button>
    </form>
</div>