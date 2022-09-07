<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Routes</h4>
<?php echo form_open('/entities/getRouteByName/'); ?>
<input class="form-control me-2" type="search" name="searchRoute" placeholder="Search Route Here" aria-label="Search" style="width: 40%;float:left">
<button class="btn btn-outline-primary" type="submit">Search</button>
</form>
<?php if (empty($routes)) : ?>
     <p  style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php endif; ?>
<a class="btn btn-primary" href="<?php echo base_url('/entities/addRoute'); ?>" style="float: right;margin-bottom:10px">+ Add new Route</a>
<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
    <thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Route Name</th>
        <th style="font-size: 20px;font-weight: bold;">Route No</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>


    </tr>
    </thead>
    <?php $count = 1;
    foreach ($routes as $route) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo $route['route_name']; ?></td>
            <td># <?php echo $route['route_no']; ?></td>
            <td>
                <?php echo form_open('/entity/route/' . $route['id']); ?>
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