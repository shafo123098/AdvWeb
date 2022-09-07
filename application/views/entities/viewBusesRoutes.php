<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Buses Route Plan</h4>

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
<!-- <form class="d-flex" style="width: 40%;float:left"> -->
<?php echo form_open('/entities/getRoutePlanViaBus/'); ?>
<input class="form-control me-2" type="search" name="searchBus" placeholder="Search by Vehicle" aria-label="Search" style="width: 40%;float:left;">
<button class="btn btn-outline-primary" type="submit">Search</button>
</form>
<!-- <form class="d-flex" style="width: 40%;float:left;margin-left:25px;"> -->
<?php echo form_open('/entities/getRoutePlanViaRoute/'); ?>
<div>
    <input class="form-control me-2" type="search" name="searchRoute" placeholder="Search by Route" aria-label="Search" style="width: 40%;float:left">
    <button class="btn btn-outline-primary" type="submit">Search</button>
</div>

<input class="btn btn-info" type="button" onclick="printDiv('table')" value="Print" style="float:left;margin-top:18px;margin-bottom:10px" />

</form>
<a class="btn btn-primary" href="<?php echo base_url('/entities/addBusRoute'); ?>" style="float: right;margin-bottom:10px;display: <?php echo $display1; ?>;">+ Add new Route to Bus</a>
<?php if (empty($busesRoutes)) : ?>
    <p style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php endif; ?>

<div id="table" class="table-responsive">
    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th style="font-size: 20px;font-weight: bold;">#</th>
                <th style="font-size: 20px;font-weight: bold;">Registration No</th>
                <th style="font-size: 20px;font-weight: bold;">Route #</th>
                <th style="font-size: 20px;font-weight: bold;">Route Name</th>
                <th style="font-size: 20px;font-weight: bold;">Status</th>
                <th style="font-size: 20px;font-weight: bold;">Time</th>
                <th style="font-size: 20px;font-weight: bold;">Starting Point</th>
                <th style="font-size: 20px;font-weight: bold;">Action</th>

            </tr>
        </thead>
        <?php $count = 1;
        foreach ($busesRoutes as $busRoute) : ?>

            <tr id="row">
                <th><?php echo $count; ?></th>
                <td><?php echo strtoupper($busRoute['registration_no']); ?></td>
                <td><?php echo $busRoute['route_no']; ?></td>
                <td><?php echo $busRoute['route_name']; ?></td>
                <td><?php echo $busRoute['status']; ?></td>
                <td><?php echo $busRoute['time']; ?></td>
                <td><?php echo $busRoute['starting_point']; ?></td>
                <td>

                    <!-- <form method="POST" action="/entities/viewRoutePlan"> -->
                    <?php echo form_open('entities/viewRoutePlan'); ?>
                    <input type="hidden" value="<?php echo $busRoute['bus_id'] ?>" name="bus_id">
                    <input type="hidden" value="<?php echo $busRoute['route_id'] ?>" name="route_id">
                    <button type="submit" class="btn btn-secondary">Read More</button>
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