<h2><?= $title ?></h2>
<div class="container" id="viewDiv" style="border-style:solid;width:70%;float:left;border-radius:10px;border-width:0px;background-color:#ededed;padding:20px">
    <img src="<?php echo base_url() ?>/assets/img/student.png" width="170px" height="170px" style="float: right;">

    <p><strong> Name : </strong><?php echo $student[0]['first_name']; ?> <?php echo $student[0]['last_name']; ?></p>
    <p><strong> Roll No : </strong><?php echo $student[0]['roll_no']; ?></p>
    <p><strong> Email Address : </strong><?php echo $student[0]['email_address']; ?></p>

    <p><strong> Age : </strong><?php echo $student[0]['age']; ?></p>
    <p><strong> Address : </strong><?php echo $student[0]['address']; ?></p>
    <p><strong> Gender : </strong><?php echo $student[0]['gender']; ?></p>
    <p><strong> Route Name : </strong><?php echo $route[0]['route_name']; ?></p>
    <p><strong> Route No : </strong><?php echo $route[0]['route_no']; ?></p>
    <hr>
    <hr>
    <a class="btn btn-primary pull-left" style="margin-bottom: 10; width:73px" href="/entities/editStudent/<?php echo $student[0]['id']; ?>">Edit</a>
    <?php echo form_open('/entities/deleteStudent/' . $student[0]['id']); ?>
    <input type="submit" style="margin-left: 5px;" value="Delete" class="btn btn-danger">
    </form>

</div>