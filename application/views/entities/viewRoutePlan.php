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
    <img src="<?php echo base_url() ?>/assets/img/routePlan.png" width="170px" height="170px" style="float: right;">

    <p><strong> Registration No : </strong><?php echo strtoupper($routePlan[0]['registration_no']); ?></p>
    <p><strong> Type : </strong><?php echo $routePlan[0]['type']; ?></p>
    <p><strong> Bus : </strong><?php echo $routePlan[0]['assign_status']; ?></p>
    <p><strong> Route Name : </strong><?php echo $routePlan[0]['route_name']; ?></p>
    <p><strong> Route Number : </strong><?php echo $routePlan[0]['route_no']; ?></p>
    <p><strong> Status : </strong><?php echo $routePlan[0]['status']; ?></p>
    <p><strong> Time : </strong><?php echo $routePlan[0]['time']; ?></p>
    <p><strong> Starting Point : </strong><?php echo $routePlan[0]['starting_point']; ?></p>
    <p><strong> Via : </strong><?php echo $routePlan[0]['via']; ?></p>


    <hr>
    <hr>
    <!-- <a class="btn btn-primary pull-left" style="margin-bottom: 10; width:73px" href="/entities/editRoute/<?php echo $routePlan[0]['id']; ?>">Edit</a> -->

    <?php echo form_open('/entities/editRoutePlan/'); ?>
    <input type="hidden" value="<?php echo $routePlan[0]['bus_id'] ?>" name="bus_id">
    <input type="hidden" value="<?php echo $routePlan[0]['route_id'] ?>" name="route_id">
    <button type="submit" style="width:73px;" class="btn btn-primary" <?php echo $display; ?>>Edit</button>
    </form>

    <?php echo form_open('/entities/deleteRoutePlan/'); ?>
    <input type="hidden" value="<?php echo $routePlan[0]['bus_id'] ?>" name="bus_id">
    <input type="hidden" value="<?php echo $routePlan[0]['route_id'] ?>" name="route_id">
    <button type="submit" class="btn btn-danger" <?php echo $display; ?>>Delete</button>
    </form>

</div>