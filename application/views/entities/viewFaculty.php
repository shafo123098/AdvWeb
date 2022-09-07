<h2><?= $title ?></h2>
<div class="container" id="viewDiv" style="border-style:solid;width:70%;float:left;border-radius:10px;border-width:0px;background-color:#ededed;padding:20px">
    <img src="<?php echo base_url() ?>/assets/img/faculty.png" width="170px" height="170px" style="float: right;">

    <p><strong> Name : </strong><?php echo $faculty[0]['first_name']; ?> <?php echo $faculty[0]['last_name']; ?></p>
    <p><strong> Address: </strong><?php echo $faculty[0]['address']; ?></p>
    <p><strong> Email Address: </strong><?php echo $faculty[0]['email_address']; ?></p>

    <hr>
    <hr>
    <a class="btn btn-primary pull-left" style="margin-bottom: 10; width:73px" href="/entities/editFaculty/<?php echo $faculty[0]['id']; ?>">Edit</a>
    <?php echo form_open('/entities/deleteFaculty/' . $faculty[0]['id']); ?>
    <input type="submit" style="margin-left: 5px;" value="Delete" class="btn btn-danger">
    </form>

</div>