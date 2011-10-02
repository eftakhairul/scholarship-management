<div class="block">

    <div class="block_head">
        <h2>All Users</h2>
        <ul>
            <a href="<?php echo site_url("user/addUser") ?>">Add User</a>
        </ul>

    </div> <!--.block_head ends -->

    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th class="centered">Name</th>
                <th class="centered">Username</th>
                <th class="centered">Type</th>
                <th class="action">Action</th>
            </tr>

            <?php if (empty ($users)) : ?>

            <tr>
                <td colspan="4" class="nodatamsg">No user is found.</td>
            </tr>

            <?php else : foreach($users as $user) : ?>

            <tr>
                <td><?php echo $user['name'] ?></td>
                <td class="centered"><?php echo $user['username'] ?></td>
                <td class="centered"><?php echo $user['title'] ?></td>
                <td class="action">
                    <a href="<?php echo site_url("user/editUser/id/{$user['user_id']}") ?>">Edit Profile</a> |
                    <a href="<?php echo site_url("user/changePassword/id/{$user['user_id']}") ?>" >Change Password</a> |
                    <a href="<?php echo site_url("user/deleteUser/id/{$user['user_id']}") ?>" id='delete'>Delete</a>
                </td>
            </tr>

            <?php endforeach; endif ?>

        </table>

        <div class="pagination right">
            <?php echo $this->pagination->create_links() ?>
        </div> <!--.pagination ends-->

    </div> <!--.block_content ends-->

</div> <!--.block ends-->