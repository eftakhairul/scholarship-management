<div class="block">

    <div class="block_head">
        <h2>Tuition Fee Details</h2>
        <ul>
            <li><a href="<?php echo site_url('tuition/add') ?>">Add Tuition Fees</a></li>
        </ul>
        
    </div> <!--.block_head ends -->
    
    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">

            <thead>

                <tr>
                    <th class="centered" >Sl.</th> 
                    <th class="centered" >Department Name</th>
                    <th class="centered" >Year</th>
                    <th class="centered" >Semester</th>
                    <th class="centered" >Credit Fees</th>
                    <th class="centered" >Action</th>
                </tr>

            </thead>
            
            <tbody>

            <?php $semester = $this->config->item('years'); $cnt = 1; if (empty ($tuitions)) : ?>
                
            <tr>
                <td colspan="6" class="nodatamsg">No data founds.</td>
            </tr>

            <?php else : foreach($tuitions AS $row) : ?>
                
            <tr>
                <td class="centered"><?php echo $cnt++; ?></td>
                <td class="centered"><?php echo $row['department_name']; ?></td>
                <td class="centered"><?php echo $row['year']; ?></td>
                <td class="centered"><?php echo $semester[$row['semester_id']]; ?></td>
                <td class="centered"><?php echo $row['credit_fees']; ?></td>
                <td class="centered">
                    <a href="<?php echo site_url("tuition/edit/{$row['tuition_id']}") ?>">Edit</a>
                    | <a href="<?php echo site_url("tuition/delete/id/{$row['tuition_id']}") ?>" id='delete'>Delete</a>
                </td>
            </tr>
            <?php endforeach; endif ?>
                
            </tbody>            
        </table>

    </div> <!--.block_content ends-->

</div> <!--.block ends-->
