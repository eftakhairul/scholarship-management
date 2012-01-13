<div class="block">

    <div class="block_head">
        <h2>Department Details</h2>
        <ul>
            <li><a href="<?php echo site_url('department/add') ?>">Create Department</a></li>
        </ul>
        
    </div> <!--.block_head ends -->
    
    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">

            <thead>

                <tr>
                    <th class="centered" >Sl.</th> 
                    <th class="centered" >Title</th>
                    <th class="centered" >Action</th>
                </tr>

            </thead>
            
            <tbody>

            <?php $cnt = 1; if (empty ($departments)) : ?>
                
            <tr>
                <td colspan="3" class="nodatamsg">No number founds.</td>
            </tr>

            <?php else : foreach($departments AS $row) : ?>
                
            <tr>
                <td class="centered"><?php echo $cnt++; ?></td>
                <td class="centered"><?php echo $row['department_name']; ?></td>
                <td class="centered">
                    <a href="<?php echo site_url("department/edit/{$row['department_name']}") ?>">Edit</a>
                    | <a href="<?php echo site_url("department/delete/id/{$row['department_name']}") ?>" id='delete'>Delete</a>
                </td>

            </tr>
            <?php endforeach; endif ?>
                
            </tbody>            
        </table>

    </div> <!--.block_content ends-->

</div> <!--.block ends-->
