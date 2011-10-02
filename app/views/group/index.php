<div class="block">

    <div class="block_head">
        <h2>All Groups</h2>
        <ul>
            <li><a href="<?php echo site_url("group/addGroup") ?>">Add Group</a></li>
        </ul>

    </div> <!--.block_head ends -->

    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th class="centered">Group Associated Name</th>
                <th class="centered">Print</th>
                <th class="action">Action</th>
            </tr>

            <?php if (empty ($groups)) : ?>

            <tr>
                <td colspan="4" class="nodatamsg">No user is found.</td>
            </tr>

            <?php else : foreach($groups as $row) : ?>

            <?php if($row['group_id'] != 1):?>
            <tr>
                <td class="centered"><?php echo $row['associated_name'] ?></td>
                <td class="centered"><?php echo $row['print_title'] ?></td>
                <td class="action">
                    <a href="<?php echo site_url("group/editGroup/{$row['group_id']}") ?>">Edit</a> |
                    <a href="<?php echo site_url("group/deleteGroup/id/{$row['group_id']}") ?>" id='delete'>Delete</a>
                </td>
            </tr>
            <?php endif; ?>

            <?php endforeach; endif ?>

        </table>

        <div class="pagination right">
            <?php echo $this->pagination->create_links() ?>
        </div> <!--.pagination ends-->

    </div> <!--.block_content ends-->

</div> <!--.block ends-->