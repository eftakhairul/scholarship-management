<div class="block">

    <div class="block_head">
        <h2>Program Details</h2>
        <ul>
            <li><a href="<?php echo site_url('program/add') ?>">Add Program</a></li>
        </ul>
        
    </div> <!--.block_head ends -->
    
    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">

            <thead>

                <tr>
                    <th class="centered" >Sl.</th> 
                    <th class="centered" >Code</th>
                    <th class="centered" >Program Name</th>
                    <th class="centered" >Department</th>
                    <th class="centered" >Action</th>
                </tr>

            </thead>
            
            <tbody>

            <?php $cnt = 1; if (empty ($programs)) : ?>
                
            <tr>
                <td colspan="5" class="nodatamsg">No number founds.</td>
            </tr>

            <?php else : foreach($programs AS $row) : ?>
                
            <tr>
                <td class="centered"><?php echo $cnt++; ?></td>
                <td class="centered"><?php echo $row['code']; ?></td>
                <td class="centered"><?php echo $row['name']; ?></td>
                <td class="centered"><?php echo $row['department_name']; ?></td>
                <td class="centered">
                    <a href="<?php echo site_url("program/edit/{$row['program_id']}") ?>">Edit</a>
                    | <a href="<?php echo site_url("program/delete/id/{$row['program_id']}") ?>" id='delete'>Delete</a>
                </td>
            </tr>
            <?php endforeach; endif ?>
                
            </tbody>            
        </table>

    </div> <!--.block_content ends-->

</div> <!--.block ends-->
