<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Wakasek Akademik</li><!-- /.menu-title -->
                
                <li>
                    <a href="<?php echo base_url();?>master/matapelajaran"> <i class="menu-icon fa fa-book"></i>Mata Pelajaran</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>master/guru"> <i class="menu-icon fa fa-male"></i>Guru</a>
                </li>
                <?php if($this->session->tahunajaran != ""){ ?> 
                
                <li>
                    <a href="<?php echo base_url();?>master/gurutahun"> <i class="menu-icon fa fa-thumbs-up"></i>Guru - Tahun Ajaran</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>master/kelas"> <i class="menu-icon fa fa-hdd-o"></i>Kelas</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>master/gurumatpel"> <i class="menu-icon fa fa-calendar"></i>Guru - Mata Pelajaran</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>master/jadwal"> <i class="menu-icon fa fa-book"></i>Jadwal</a>
                </li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>

