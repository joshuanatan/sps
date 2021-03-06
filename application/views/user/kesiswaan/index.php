
<div class="row">
    <div class="col-xl-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="box-title">TAHUN AJARAN</h4>
            </div>
            <div class="card-body">
                <form class = "form-inline" action = "<?php echo base_url();?>master/tahunajaran/setTahunAjaran" method="post">
                    <select class = "form-control col-lg-7" name = "id_tahun_ajaran">
                        <?php foreach($tahunajaran as $a){ ?> 
                        <option value = "<?php echo $a->id_tahun_ajaran?>" <?php if($a->id_tahun_ajaran == $this->session->tahunajaran) echo "selected";?>><?php echo $a->tahun_awal;?>/<?php echo $a->tahun_akhir;?></option>
                        <?php } ?>
                    </select>
                    <input type ="submit" class = "form-control col-lg-2" style = "margin-left:10px;">
                    <button type="button" class="btn btn-success col-lg-2" style = "margin-left:10px;" data-toggle="modal" data-target="#mediumModal2">TAMBAH</button>
                </form>
            </div>
        </div> <!-- /.card -->
    </div>
</div>
<?php if($this->session->tahunajaran != ""){ ?> 
<div class="row">
    <div class="col-xl-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="box-title">Siswa</h4>
            </div>
            <div class="card-body">
                <div class="table-stats">
                    <table class="table table-stripped" id = "bootstrap-data-table-export">
                        <thead>
                            <tr>
                                <th>ID Siswa</th>
                                <th>Nama Siswa</th>
                                <th>Jurusan Siswa</th>
                                <th>Email Siswa</th>
                                <th>No Siswa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($siswa as $a){ ?> 
                            <tr>
                                <td><?php echo $a->id_siswa;?></td>
                                <td><?php echo ucfirst($a->nama_depan)." ".ucfirst($a->nama_belakang);?></td>
                                <td><?php echo $a->jurusan;?></td>
                                <td><?php echo $a->email;?></td>
                                <td><?php echo $a->nomor_telpon;?></td>
                                <td><?php if($a->status == "0") echo "AKTIF"; else echo "TIDAK AKTIF";?></td>
                                <td>
                                    <button class="btn btn-secondary btn-warning col-lg-12 mb-1" data-toggle="modal" data-target="#mediumModal<?php echo $a->id_user;?>">DETAIL</button>
                                    
                                </td>
                            </tr>
                            <?php 
                                                        if($a->nama_orangtua == ""){
                                                            $namaortu = "-";
                                                        }
                                                        else {
                                                            $namaortu = $a->nama_orangtua;
                                                        }
                                                        if($a->nomor_telpon_ortu == ""){
                                                            $nohportu = "-";
                                                        }
                                                        else {
                                                            $nohportu = $a->nomor_telpon_ortu;
                                                        }
                                                        if($a->email_orangtua == ""){
                                                            $emailortu = "-";
                                                        }
                                                        else {
                                                            $emailortu = $a->email_orangtua;
                                                        }
                                                        $data = array(
                                                            "id_user" => $a->id_user,
                                                            "nama_depan" => $a->nama_depan,
                                                            "nama_belakang" => $a->nama_belakang,
                                                            "tanggal_lahir" => $a->tanggal_lahir,
                                                            "nomor_telpon" => $a->nomor_telpon,
                                                            "email" => $a->email,
                                                            "alamat" => $a->alamat,
                                                            "jurusan" => $a->jurusan,
                                                            "nama_ortu" => $namaortu,
                                                            "nohp_ortu" => $nohportu,
                                                            "email_ortu" => $emailortu
                                                        );
                                                        $this->load->view("user/kesiswaan/edit/siswa",$data);
                            ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- /.table-stats -->
            </div>
        </div> <!-- /.card -->
        
    </div>  <!-- /.col-lg-8 -->
        <?php } ?> 
</div>
<div class="modal fade" id="mediumModal2" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">PENAMBAHAN TAHUN AJARAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action = "<?php echo base_url();?>master/tahunajaran/insertTahunAjaran2" method="post">
                <div class="modal-body">
                        <div class = "form-group col-lg-12">
                            <label>AWAL TAHUN AJARAN</label>
                            <input type = "number" class = "form-control"  name = "awal" id = "awal">
                        </div>
                        <div class = "form-group col-lg-12">
                            <label>AKHIR TAHUN AJARAN</label>
                            <input type = "number" class = "form-control" onclick = "abc()" name = "akhir" id = "akhir" readonly placeholder="Tekan disini" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function abc(){
        var angka = parseInt(document.getElementById("awal").value)+1;
        //alert(angka);
        document.getElementById("akhir").value = angka;
    }
</script>