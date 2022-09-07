<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;">Reports</h4>


<div id="table" class="table-responsive">
<table class=" table table-striped table-hover">
<thead>
    <tr>
        <th style="font-size: 20px;font-weight: bold;">#</th>
        <th style="font-size: 20px;font-weight: bold;">Reported By</th>
        <th style="font-size: 20px;font-weight: bold;">Description</th>
        <th style="font-size: 20px;font-weight: bold;">Report Date</th>
        <th style="font-size: 20px;font-weight: bold;">Action</th>
    </tr>
    </thead>
    <?php $count = 1;
    foreach ($reports as $report) : ?>

        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo $report['first_name'] ?> <?php echo $report['last_name'] ?> (<?php echo $report['username'] ?>)</td>
            <td><?php echo $report['description'] ?></td>
            <td><?php echo $report['created_at'] ?></td>
            <td>
                    <a class="btn btn-primary pull-left" style="float:left;margin-right: 20px;width:73px" href="/users/editReport/<?php echo $report['id']; ?>">Edit</a>

                    <?php echo form_open('/users/deleteReport/' . $report['id']); ?>
                    <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
        </tr>
    <?php $count++;
    endforeach; ?>

</table>
</div>