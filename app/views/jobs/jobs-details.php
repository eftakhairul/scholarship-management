<div class="block">

    <div class="block_head">
        <h2><?php echo $jobs['title']; ?></h2>
    </div> <!--.block_head ends -->
    
    <div class="block_content">
        <pre>
            <?php echo $jobs['description']; ?>
        </pre>
        
        <p>
            <?php if($this->session->userdata('user_type') == APPLICANT): ?>
            <input type="button" value="Apply Here" id="submit-cancel" class="submit small" onclick="window.location='/jobs/jobApply'" />
            <?php endif; ?>
        </p>
    </div> <!--.block_content ends-->

</div> <!--.block ends-->
