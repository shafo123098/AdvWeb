<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Faculty</h4>
<?php echo form_open('/entities/getFacultyByName/'); ?>
<input class="form-control me-2" type="search" name="searchFaculty" placeholder="Search Faculty Here" aria-label="Search" style="width: 40%;float:left">
<button class="btn btn-outline-primary" type="submit">Search</button>
</form>
<a class="btn btn-primary" href="<?php echo base_url('/entities/addFaculty'); ?>" style="float: right;margin-bottom:10px">+ Add new Faculty</a>
<?php if (empty($faculties)) : ?>
     <p  style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php endif; ?>
<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
    <thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Name</th>
        <th style="font-size: 20px;font-weight: bold;">Contact</th>
        <th style="font-size: 20px;font-weight: bold;">Address</th>
        <th style="font-size: 20px;font-weight: bold;">Email Address</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>

    </tr>
    </thead>
    <?php $count = 1;
    foreach ($faculties as $faculty) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo $faculty['first_name']; ?> <?php echo $faculty['last_name']; ?></td>
            <td><?php echo $faculty['contact']; ?></td>
            <td><?php echo $faculty['address']; ?></td>
            <td><?php echo $faculty['email_address']; ?></td>
            <td>
                <?php echo form_open('/entity/faculty/' . $faculty['id']); ?>
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