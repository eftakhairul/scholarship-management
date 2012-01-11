<div class="block">

    <div class="block_head">
        <h2>You Applied Jobs</h2>
    </div> <!--.block_head ends -->
    
    <div class="block_content">

        <table cellpadding="0" cellspacing="0" width="100%">

            <thead>

                <tr>
                    <th class="centered" >Sl.</th>                     
                    <th class="centered" >Jobs Name </th>
                    <th class="centered" >Type</th>
                    <th class="centered" >Applicantion Date</th>
                </tr>

            </thead>
            
            <tbody>
                <?php $cnt = 1; if (empty ($jobs)) : ?>

                <tr>
                    <td colspan="4" class="nodatamsg">You didn't apply any jobs</td>
                </tr>

                <?php else : foreach($jobs AS $row) : ?>

                <tr>
                    <td class="centered"><?php echo $cnt++; ?></td>
                     <td class="centered"><a href="/jobs/jobDetails/<?php echo $row['job_id']?>" ><?php echo $row['title']; ?></a></td>
                    <td class="centered"><?php echo $row['types']; ?></td>
                    <td class="centered"><?php echo DateHelper::mysqlToHuman($row['application_date']) ?></td>
                </tr>

                <?php endforeach; endif ?>
                </tbody>
        </table>

        <div class="pagination right">
            <?php echo $this->pagination->create_links() ?>
        </div> <!--.pagination ends-->

    </div> <!--.block_content ends-->

</div> <!--.block ends-->
