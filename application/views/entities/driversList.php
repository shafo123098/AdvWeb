<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Drivers</h4>
<?php echo form_open('/entities/getDriverByName/'); ?>
<input class="form-control me-2" type="search" name="searchDriver" placeholder="Search Driver Here" aria-label="Search" style="width: 40%;float:left">
<button class="btn btn-outline-primary" type="submit">Search</button>
</form>
<input class="btn btn-info" type="button" onclick="printDiv('table')" value="Print" style="float: left;"/>

<a class="btn btn-primary" href="<?php echo base_url('/entities/addDriver'); ?>" style="float: right;margin-bottom:10px">+ Add new Driver</a>
<?php if (empty($drivers)) : ?>
     <p  style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php endif; ?>
<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
<thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Name</th>
        <th style="font-size: 20px;font-weight: bold;">Address</th>
        <th style="font-size: 20px;font-weight: bold;">Contact</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>

    </tr>
    </thead>
    <?php $count = 1;
    foreach ($drivers as $driver) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo $driver['first_name']; ?> <?php echo $driver['last_name']; ?></td>
            <td><?php echo $driver['address']; ?></td>
            <td><?php echo $driver['contact']; ?></td>
            <td>
                <?php echo form_open('/entity/driver/' . $driver['id']); ?>
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