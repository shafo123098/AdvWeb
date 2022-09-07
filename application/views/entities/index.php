<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Students</h4>
<?php echo form_open('/entities/getStudentByRollNo/'); ?>
<input class="form-control me-2" type="search" name="searchStudent" placeholder="Search Student Here" aria-label="Search" style="width: 40%;float:left">
<button class="btn btn-outline-primary" type="submit">Search</button>
</form>
<a class="btn btn-primary" href="<?php echo base_url('/entities/addStudent'); ?>" style="float: right;margin-bottom:10px">+ Add new Student</a>
<?php if (empty($students)) : ?>
     <p  style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php endif; ?>
<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
    <thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Name</th>
        <th style="font-size: 20px;font-weight: bold;">Roll No</th>
        <th style="font-size: 20px;font-weight: bold;">Address</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>

    </tr>
    </thead>
    <?php $count = 1;
    foreach ($students as $student) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo $student['first_name']; ?> <?php echo $student['last_name']; ?></td>
            <td><?php echo $student['roll_no']; ?> </td>
            <td><?php echo $student['address']; ?> </td>
            <td>
                <!-- <p><a class="btn btn-secondary" href="<?php echo site_url('/entity/' . $student['id']); ?>">Read more</a></p> -->
                <?php echo form_open('/entity/' . $student['id']); ?>
                <input type="submit" value="Read More" class="btn btn-secondary">
                </form>
            </td>
        </tr>
    <?php $count++;
    endforeach; ?>

</table>
</div>
<div class="pagination-links" style="margin: 30px;display:flex;justify-content:center;">
    <?php echo $this->pagination->create_links(); ?>
</div>