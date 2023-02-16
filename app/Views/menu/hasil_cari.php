<form action="#" method="POST" class="search-box mt-5">
    <div class="card-body table-responsive p-4">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Naskah</th>
                    <th scope="col">Nomor Naskah</th>
                    <th scope="col">Hal</th>
                    <th scope="col">Asal Naskah</th>
                    <th scope="col">Tujuan Naskah</th>
                    <th scope="col">Tingkat Urgensi</th>
                    <th scope="col">Sifat Naskah</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($data_table as $k) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= date('d-m-Y', strtotime($k['tanggal_naskah'])) ?></td>
                        <td><?= $k['nomor_naskah'] ?></td>
                        <td><?= $k['hal'] ?></td>
                        <td><?= $k['nama_unit_kerja'] ?></td>
                        <td><?= $k['tujuan_naskah'] ?></td>

                        <td>
                            <?php if ($k['tingkat_urgensi'] == 'Penting') : ?>
                                <div class="badge badge-info"> Penting</div>
                            <?php else : ?>
                                <div class="badge badge-secondary"> Segera </div>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($k['sifat_naskah'] == 'Rahasia') : ?>
                                <div class="badge badge-warning"> Rahasia </div>
                            <?php endif; ?>

                            <?php if ($k['sifat_naskah'] == 'Penting') : ?>
                                <div class="badge badge-primary"> Penting </div>
                            <?php endif; ?>
                            <?php if ($k['sifat_naskah'] == 'Biasa') : ?>
                                <div class="badge badge-success"> Biasa </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($k['sifat_naskah'] == 'Rahasia') : ?>
                                <a class="badge badge-primary btn-sm" onclick="lihat(<?= $k['id'] ?>)" title="Lihat PendataTangan"><i class="fas fa-eye"></i></a>
                            <?php else : ?>
                                <a class="badge badge-primary btn-sm" onclick="lihat(<?= $k['id'] ?>)" title="Lihat PendataTangan"><i class="fas fa-eye"></i></a>

                                <a class="badge badge-success btn-sm" href="<?= base_url('uploads/file_naskah/' . $k['file_naskah']) ?>" target="_blank" title="Download Surat"><i class="fas fa-download"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</form>