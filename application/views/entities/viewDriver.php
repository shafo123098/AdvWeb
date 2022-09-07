<h2><?= $title ?></h2>
<input class="btn btn-info" type="button" onclick="printDiv('viewDiv')" value="Print" style="float: left;"/>
<br><br>
<div class="container" id="viewDiv" style="border-style:solid;width:70%;float:left;border-radius:10px;border-width:0px;background-color:#ededed;padding:20px">
    <img src="<?php echo base_url() ?>/assets/img/driver.png" width="170px" height="170px" style="float: right;">

    <p><strong> Name : </strong><?php echo $driver[0]['first_name']; ?> <?php echo $driver[0]['last_name']; ?></p>
    <p><strong> Age: </strong><?php echo $driver[0]['age']; ?></p>
    <p><strong> Address: </strong><?php echo $driver[0]['address']; ?></p>
    <p><strong> Contact: </strong><?php echo $driver[0]['contact']; ?></p>
    <hr>
    <h4 style="text-align: center;margin-top:30px;">Assigned Bus Information</h4>
    <p><strong> Bus Registration No: </strong><?php echo strtoupper($bus[0]['registration_no']); ?></p>
    <p><strong> Bus Type: </strong><?php echo $bus[0]['type']; ?></p>

    <hr>
    <hr>
    <a class="btn btn-primary pull-left" style="margin-bottom: 10; width:73px" href="/entities/editDriver/<?php echo $driver[0]['id']; ?>">Edit</a>
    <?php echo form_open('/entities/deleteDriver/' . $driver[0]['id']); ?>
    <input type="submit" style="margin-left: 5px;" value="Delete" class="btn btn-danger">
    </form>

</div>