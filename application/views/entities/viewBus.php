<h2><?= $title ?></h2>
<input class="btn btn-info" type="button" onclick="printDiv('viewDiv')" value="Print" style="float: left;"/>
<br><br>
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
<div class="container" id="viewDiv" style="border-style:solid;width:70%;float:left;border-radius:10px;border-width:0px;background-color:#ededed;padding:20px">
    <img src="<?php echo base_url() ?>/assets/img/bus.png" width="170px" height="170px" style="float: right;">

    <p><strong> Registration No : </strong><?php echo strtoupper($bus[0]['registration_no']); ?></p>
    <p><strong> Type: </strong><?php echo $bus[0]['type']; ?></p>
    <p><strong> Assign Status: </strong><?php echo $bus[0]['assign_status']; ?></p>
    <p><strong> Location Status : </strong><?php echo strtoupper($bus[0]['location_status']); ?></p>
    <hr>
    <?php echo form_open('/entities/busHistory/' . $bus[0]['id']); ?>
    <input type="submit" value="Maintenance History" class="btn btn-warning" style="float:right;display:<?php echo $display1;?>">
    </form>
    <a class="btn btn-primary" href="<?php echo base_url('/entities/addBusHistory/' . $bus[0]['id']); ?>" style="float: right;margin-bottom:10px;margin-right:5px;display:<?php echo $display1;?>">+ Add new History</a>

    <a class="btn btn-primary pull-left" style="margin-bottom: 10; width:73px;display:<?php echo $display1; ?>" href="/entities/editBus/<?php echo $bus[0]['id']; ?>">Edit</a>
    
    <?php echo form_open('/entities/deleteBus/' . $bus[0]['id']); ?>
    <input style="margin-left: 5px;display:<?php echo $display1;?>" type="submit" value="Delete" class="btn btn-danger">
    </form>


</div>