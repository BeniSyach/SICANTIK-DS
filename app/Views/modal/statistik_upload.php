<!-- Modal -->
<div class="modal fade" id="modalStatistik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Statistik Upload</h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body table-responsive p-4">
                    <table class="table" id="datasurat">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Bidang / Sub Bagian</th>
                                <th scope="col">Hari <?= date('d-m-Y') ?></th>
                                <th scope="col">Bulan <?= date('m-Y') ?></th>
                                <th scope="col">Tahun <?= date('Y') ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data_surat as $dt) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $dt['username'] ?> </td>
                                    <td><?= $dt['nama_bidang'] ?></td>
                                    <td><?= $dt['hari_ini'] ?> Kali Upload Naskah</td>
                                    <td><?= $dt['bulan_ini'] ?> Kali Upload Naskah</td>
                                    <td><?= $dt['tahun_ini'] ?> Kali Upload Naskah</td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12" style="background:rgb(192, 192, 102)">
                            <canvas id="myChart" width="200" height="100"></canvas>

                        </div>

                    </div>


                </div>
            </div>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn_close" data-dismiss="modal">Kembali</button>
        </div> -->
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".btn_close").click(function() {
            $('#modalStatistik').modal('hide');
        })
    });


    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php foreach ($data_surat as $dt) : ?> "<?= $dt['username'] ?>",
                <?php endforeach; ?>
            ],
            datasets: [{
                label: 'Total Upload Hari Ini',
                data: [<?php foreach ($data_surat as $dt) : ?><?= $dt['hari_ini'] ?>,
                <?php endforeach; ?>
                ],
                backgroundColor: [
                    <?php foreach ($data_surat as $dt) : ?> 'rgba(255, 206, 86, 1)',
                    <?php endforeach; ?>
                ],
                borderColor: [
                    <?php foreach ($data_surat as $dt) : ?> 'rgba(255,99,132,1)',
                    <?php endforeach; ?>


                ],
                borderWidth: 1
            }, {
                label: 'Total Upload Bulan Ini',
                data: [<?php foreach ($data_surat as $dt) : ?><?= $dt['bulan_ini'] ?>,
                <?php endforeach; ?>
                ],
                backgroundColor: [
                    <?php foreach ($data_surat as $dt) : ?> 'rgba(255,99,132,1)',
                    <?php endforeach; ?>
                ],
                borderColor: [
                    <?php foreach ($data_surat as $dt) : ?> 'rgba(255,99,132,1)',
                    <?php endforeach; ?>



                ],
                borderWidth: 1
            }, {
                label: 'Total Upload Tahun Ini',
                data: [<?php foreach ($data_surat as $dt) : ?><?= $dt['tahun_ini'] ?>,
                <?php endforeach; ?>
                ],
                backgroundColor: [
                    <?php foreach ($data_surat as $dt) : ?> 'rgba(54, 162, 235, 1)',
                    <?php endforeach; ?>

                ],
                borderColor: [
                    <?php foreach ($data_surat as $dt) : ?> 'rgba(255,99,132,1)',
                    <?php endforeach; ?>

                ],
                borderWidth: 1
            }, ],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>