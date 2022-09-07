<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Buses' Maintenance History</h4>
<?php if (empty($busesHistory)) : ?>
     <p  style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php else :?>

<?php
    $display ="";
    $display1 ="";
    $allRoles = $this->session->userdata('allRoles');
    foreach($this->session->userdata('roles') as $role) : ?>
        <?php if($role['role'] == 'Gate Keeper'){
            $display="disabled";
            $display1 ="none";
        } ?>
<?php endforeach; ?>

<?php echo form_open('/entities/getBusHistoryByRegNo/'); ?>
<input class="form-control me-2" type="search" name="searchBus" placeholder="Search Bus history Here through Bus" aria-label="Search" style="width: 40%;float:left" >
<button class="btn btn-outline-primary" type="submit" >Search</button>
</form>

<?php echo form_open('/entities/getBusHistoryByDate/'); ?>
<input class="form-control me-2" type="date" name="searchBusByDate" placeholder="Search Bus history Here through Date" aria-label="Search" style="width: 40%;float:left">
<button class="btn btn-outline-primary" type="submit" >Search</button>
</form>

<input class="btn btn-info" type="button" onclick="printDiv('table')" value="Print" style="float:left;margin-top:10px;margin-bottom:10px"/>

<!-- <a class="btn btn-primary" href="<?php echo base_url('/entities/addRoute'); ?>" style="float: right;margin-bottom:10px">+ Add new History</a> -->

<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
    <thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Bus</th>
        <th style="font-size: 20px;font-weight: bold;">Description</th>
        <th style="font-size: 20px;font-weight: bold;">Date</th>
        <th style="font-size: 20px;font-weight: bold;">Cost</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>


    </tr>
    </thead>
    <?php $count = 1;
    foreach ($busesHistory as $busHistory) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo strtoupper($busHistory['registration_no']); ?></td>
            <td><?php echo $busHistory['description']; ?></td>
            <td><?php echo $busHistory['created_at']; ?></td>
            <td><?php echo $busHistory['cost']; ?></td>
            <td>
                <a class="btn btn-primary pull-left" style="float:left;margin-right: 20px;width:73px; display:<?php echo $display1;?>" href="/entities/editBusHistory/<?php echo $busHistory['id']; ?>">Edit</a>

                <?php echo form_open('/entities/deleteBusHistory/' . $busHistory['id']); ?>
                <input type="submit" value="Delete" class="btn btn-danger" <?php echo $display; ?>>
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

<?php endif; ?>