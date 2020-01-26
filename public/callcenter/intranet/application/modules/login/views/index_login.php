<?php if(isset($this->session->userdata['email'])): ?>

    <?= $this->load->view('include/login_2') ?>

<?php else: ?>

    <?= $this->load->view('include/login_1') ?>

<?php endif ?>


