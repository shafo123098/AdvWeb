<h2><?= $title ?></h2>
<div class="container" id="viewDiv" style="border-style:solid;width:70%;float:left;border-radius:10px;border-width:0px;background-color:#ededed;padding:20px">
    <img src="<?php echo base_url() ?>/assets/img/route.png" width="170px" height="170px" style="float: right;">

    <p><strong> Route Name : </strong><?php echo $route[0]['route_name']; ?></p>
    <p><strong> Route No : </strong><?php echo $route[0]['route_no']; ?></p>

    <hr>
    <hr>
    <a class="btn btn-primary pull-left" style="margin-bottom: 10; width:73px" href="/entities/editRoute/<?php echo $route[0]['id']; ?>">Edit</a>
    <?php echo form_open('/entities/deleteRoute/' . $route[0]['id']); ?>
    <input type="submit" style="margin-left: 5px;" value="Delete" class="btn btn-danger">
    </form>

</div>