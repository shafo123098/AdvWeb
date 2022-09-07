<!-- <h2><?= $title ?></h2> -->

<?php if (empty($busHistories)) : ?>
     <p  style="text-align: center;color:red"><strong>There is no data at present!</strong></p>

<?php else :?>
    <input class="btn btn-info" type="button" onclick="printDiv('printableArea')" value="Print" style="margin-bottom: 10px;"/>
<div id="printableArea">
<div id="table" class="table-responsive">
    <table class=" table table-striped table-hover" id="busHistory">
    <thead>
        <tr>
            <th style="font-size: 20px;font-weight: bold;">#</th>
            <th style="font-size: 20px;font-weight: bold;">Description</th>
            <th style="font-size: 20px;font-weight: bold;">Date</th>
            <th style="font-size: 20px;font-weight: bold;">Cost</th>
            <th style="font-size: 20px;font-weight: bold;">Actions</th>

        </tr>
        </thead>
        <?php $count = 1;
        foreach ($busHistories as $busHistory) : ?>
            <tr>
                <th><?php echo $count; ?></th>
                <td><?php echo $busHistory['description']; ?></td>
                <td><?php echo $busHistory['created_at']; ?></td>
                <td>-/ <?php echo $busHistory['cost']; ?></td>
                <td>
                    <a class="btn btn-primary pull-left" style="float:left;margin-right: 20px;width:73px" href="/entities/editBusHistory/<?php echo $busHistory['id']; ?>">Edit</a>

                    <?php echo form_open('/entities/deleteBusHistory/' . $busHistory['id']); ?>
                    <input type="submit" value="Delete" class="btn btn-danger">
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