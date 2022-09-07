<h4 style="border-bottom: 2px solid dodgerblue;width:max-content;margin-bottom:20px;"><?php echo $title; ?></h4>
<?php if (empty($inOutHistories)) : ?>
    <p style="text-align: center;color:red"><strong>There is no data at present!</strong></p>
<?php else : ?>


    <?php echo form_open('/map/getInOutHistoryByBus/'); ?>
    <input class="form-control me-2" type="search" name="searchByBus" placeholder="Search By Bus Here" aria-label="Search" required style="width: 40%;float:left">
    <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <input class="btn btn-info" type="button" onclick="printDiv('table')" value="Print" style="float: left;margin-bottom:5px" />


    <div id="table" class="table-responsive">
        <table class=" table table-striped table-hover">
            <thead>
                <tr>
                    <th style="font-size: 20px;font-weight: bold;">#</th>
                    <th style="font-size: 20px;font-weight: bold;">Bus</th>
                    <th style="font-size: 20px;font-weight: bold;">Status</th>
                    <th style="font-size: 20px;font-weight: bold;">Time</th>
                    <th style="font-size: 20px;font-weight: bold;">Action</th>

                </tr>
            </thead>
            <?php $count = 1;
            foreach ($inOutHistories as $inOutHistory) : ?>

                <tr>
                    <th><?php echo $count; ?></th>
                    <td><?php echo $inOutHistory['registration_no']; ?></td>
                    <td><?php echo $inOutHistory['status']; ?></td>
                    <td><?php echo $inOutHistory['created_at']; ?></td>
                    <td>
                        <?php echo form_open('/map/deleteBusInOutHistory/' . $inOutHistory['id']); ?>
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