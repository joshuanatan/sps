<div class = "row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Mata Pelajaran</strong>
            </div>
            <div class="card-body">
                <select class="form-control" tabindex="1" id = "matapelajaran" >
                    <option value="0" label="default">Pilih Mata Pelajaran</option>
                    <?php foreach($matpel->result() as $a){ ?>
                    <option value = "<?php echo $a->id_matpel;?>"><?php echo $a->nama_matpel;?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Bulan</strong>
            </div>
            <div class="card-body">
                <select class="form-control" tabindex="1" id = "bulan" onchange = "ambilabsen()">
                    <option value="" label="default">Pilih Bulan</option>
                    <option value="1" label="default">Januari</option>
                    <option value="2" label="default">Februari</option>
                    <option value="3" label="default">Maret</option>
                    <option value="4" label="default">April</option>
                    <option value="5" label="default">Mei</option>
                    <option value="6" label="default">Juni</option>
                    <option value="7" label="default">Juli</option>
                    <option value="8" label="default">Agustus</option>
                    <option value="9" label="default">September</option>
                    <option value="10" label="default">Oktober</option>
                    <option value="11" label="default">November</option>
                    <option value="12" label="default">Desember</option>
                    
                </select>
            </div>
        </div>
    </div>
        
</div>
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Absensi</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Bahan Pelajaran</th>
                            <th>Status Absen</th>
                        </tr>
                    </thead>
                    <tbody id = "laporanabsen">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Absensi Bulanan</h4>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>
