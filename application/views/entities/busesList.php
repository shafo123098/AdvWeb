<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Buses</h4>
<?php echo form_open('/entities/getBusByRegNo/'); ?>
<input class="form-control me-2" type="search" name="searchBus" placeholder="Search Vehicle Here" aria-label="Search" style="width: 40%;float:left">
<button class="btn btn-outline-primary" type="submit">Search</button>
</form>
<input class="btn btn-info" type="button" onclick="printDiv('table')" value="Print" style="float:left;" />
<?php
$display = "";
$display1 = "";
$allRoles = $this->session->userdata('allRoles');
foreach ($this->session->userdata('roles') as $role) : ?>
    <?php if ($role['role'] == 'Gate Keeper') {
        $display = "disabled";
        $display1 = "none";
    } ?>
<?php endforeach; ?>
<a class="btn btn-primary" href="<?php echo base_url('/entities/addBus'); ?>" style="float: right;margin-bottom:10px;display:<?php echo $display1;?>">+ Add new Bus</a>
<?php if (empty($buses)) : ?>
    <p style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php endif; ?>

<div id="table" class="table-responsive">
    <table class=" table table-striped table-hover">
        <thead>
            <tr>
                <th style="font-size: 20px;font-weight: bold;">#</th>
                <th style="font-size: 20px;font-weight: bold;">Registration No</th>
                <th style="font-size: 20px;font-weight: bold;">Type</th>
                <th style="font-size: 20px;font-weight: bold;">Assign Status</th>
                <th style="font-size: 20px;font-weight: bold;">Location Status</th>
                <th style="font-size: 20px;font-weight: bold;">Action</th>

            </tr>
        </thead>
        <?php $count = 1;
        foreach ($buses as $bus) : ?>

            <tr>
                <th><?php echo $count; ?></th>
                <td># <?php echo  strtoupper($bus['registration_no']); ?></td>
                <td><?php echo $bus['type']; ?></td>
                <?php if ($bus['assign_status'] == 'Not Assigned') : ?>
                    <td><a href="<?php echo base_url('/entities/addDriver'); ?>" class="link-danger"><?php echo $bus['assign_status']; ?></a></td>
                <?php elseif ($bus['assign_status'] == 'Assigned') : ?>
                    <td><a href="<?php echo base_url('/entities/getDriverByBus/' . $bus['id']); ?>" class="link-success"><?php echo $bus['assign_status']; ?></a></td>
                <?php endif; ?>
                <td><?php echo strtoupper($bus['location_status']); ?></td>
                <td>
                    <?php echo form_open('/entity/bus/' . $bus['id']); ?>
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