<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

    <?= $this->doctrine->em->getRepository("Entities\\Menupanel")->getMenuPanel($this->uri->segment(2),$this->uri->segment(1)) ?>

</ul>
