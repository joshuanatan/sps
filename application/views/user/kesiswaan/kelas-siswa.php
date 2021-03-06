<div class="row">
    <div class="col-xl-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="box-title">List Kelas</h4>
            </div>
            <div class="card-body">
                <form class = "form-inline" method = "post" action = "<?php echo base_url();?>master/kelassiswa/ubahkelas">
                    <select class = "form-control col-lg-8" style = "margin-right:20px" name = "kelas">
                        <?php foreach($kelas as $a){ ?>
                        <option value = "<?php echo $a->kelas.$a->jurusan.$a->urutan;?>" <?php if($this->session->idkelas == $a->id_kelas) echo "SELECTED";?>><?php echo $a->kelas." ".$a->jurusan." ".$a->urutan;?></option> <!-- waktu milih, langsung keseleksi yang siswa dikelas itu + yang belum terassign -->
                        <?php } ?>
                    </select>
                    <input type = "submit" class = "form-control col-lg-3">
                </form>
            </div>
        </div> <!-- /.card -->
    </div>
</div>
<?php if($this->session->idkelas != ""){ ?> 
<div class="row">
    <div class="col-xl-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="box-title">LIST MURID</h4>
            </div>
            <form action = "<?php echo base_url();?>master/kelassiswa/submit" method="post">
                <div class="card-body">
                    <div class="table-stats">
                        <table class="table table-stripped" id = "bootstrap-data-table-export">
                            <thead>
                                <tr>
                                    <th>ID Siswa</th>
                                    <th>Nama Siswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($assigned as $a){ ?> 
                                <tr>
                                    <td><?php echo $a->id_siswa_angkatan;?></td>
                                    <td><?php echo $a->nama_depan." ".$a->nama_belakang;?></td>
                                    <td><a href = "<?php echo base_url();?>master/kelassiswa/remove/<?php echo $a->id_kelas_siswa;?>" class = "btn btn-danger">REMOVE</a></td>
                                </tr>
                                <?php } ?>
                                <?php foreach($status as $a){ ?>
                                <tr>
                                    <td><?php echo $a->id_siswa_angkatan;?></td>
                                    <td><?php echo $a->nama_depan." ".$a->nama_belakang;?></td>
                                    <td><input type = "checkbox" name = "assign[]" value = "<?php echo $a->id_siswa_angkatan;?>"></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                <input type = "submit" class = "btn btn-success"> 
            </div>
            </form>
        </div> <!-- /.card -->
    </div>  <!-- /.col-lg-8 -->
</div>


<?php } ?>