<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $pdm_upaya_banding->getId() ?></td>
    </tr>
    <tr>
      <th>No akta:</th>
      <td><?php echo $pdm_upaya_banding->getNoAkta() ?></td>
    </tr>
    <tr>
      <th>Tgl akta:</th>
      <td><?php echo $pdm_upaya_banding->getTglAkta() ?></td>
    </tr>
    <tr>
      <th>No memori:</th>
      <td><?php echo $pdm_upaya_banding->getNoMemori() ?></td>
    </tr>
    <tr>
      <th>Tgl memori:</th>
      <td><?php echo $pdm_upaya_banding->getTglMemori() ?></td>
    </tr>
    <tr>
      <th>Isi memori:</th>
      <td><?php echo $pdm_upaya_banding->getIsiMemori() ?></td>
    </tr>
    <tr>
      <th>No putusan:</th>
      <td><?php echo $pdm_upaya_banding->getNoPutusan() ?></td>
    </tr>
    <tr>
      <th>Tgl putusan:</th>
      <td><?php echo $pdm_upaya_banding->getTglPutusan() ?></td>
    </tr>
    <tr>
      <th>Isi putusan:</th>
      <td><?php echo $pdm_upaya_banding->getIsiPutusan() ?></td>
    </tr>
    <tr>
      <th>Id tersangka:</th>
      <td><?php echo $pdm_upaya_banding->getIdTersangka() ?></td>
    </tr>
    <tr>
      <th>Jenis putusan:</th>
      <td><?php echo $pdm_upaya_banding->getJenisPutusan() ?></td>
    </tr>
    <tr>
      <th>Pj pidana coba:</th>
      <td><?php echo $pdm_upaya_banding->getPjPidanaCoba() ?></td>
    </tr>
    <tr>
      <th>Pj masa coba:</th>
      <td><?php echo $pdm_upaya_banding->getPjMasaCoba() ?></td>
    </tr>
    <tr>
      <th>Pj badan tahun:</th>
      <td><?php echo $pdm_upaya_banding->getPjBadanTahun() ?></td>
    </tr>
    <tr>
      <th>Pj badan bulan:</th>
      <td><?php echo $pdm_upaya_banding->getPjBadanBulan() ?></td>
    </tr>
    <tr>
      <th>Pj badan hari:</th>
      <td><?php echo $pdm_upaya_banding->getPjBadanHari() ?></td>
    </tr>
    <tr>
      <th>Pj denda rp:</th>
      <td><?php echo $pdm_upaya_banding->getPjDendaRp() ?></td>
    </tr>
    <tr>
      <th>Pj sub tahun:</th>
      <td><?php echo $pdm_upaya_banding->getPjSubTahun() ?></td>
    </tr>
    <tr>
      <th>Pj sub bulan:</th>
      <td><?php echo $pdm_upaya_banding->getPjSubBulan() ?></td>
    </tr>
    <tr>
      <th>Pj sub hari:</th>
      <td><?php echo $pdm_upaya_banding->getPjSubHari() ?></td>
    </tr>
    <tr>
      <th>Pj biaya:</th>
      <td><?php echo $pdm_upaya_banding->getPjBiaya() ?></td>
    </tr>
    <tr>
      <th>Kurungan tahun:</th>
      <td><?php echo $pdm_upaya_banding->getKurunganTahun() ?></td>
    </tr>
    <tr>
      <th>Kurungan bulan:</th>
      <td><?php echo $pdm_upaya_banding->getKurunganBulan() ?></td>
    </tr>
    <tr>
      <th>Kurungan hari:</th>
      <td><?php echo $pdm_upaya_banding->getKurunganHari() ?></td>
    </tr>
    <tr>
      <th>Denda:</th>
      <td><?php echo $pdm_upaya_banding->getDenda() ?></td>
    </tr>
    <tr>
      <th>Putusan tambahan:</th>
      <td><?php echo $pdm_upaya_banding->getPutusanTambahan() ?></td>
    </tr>
    <tr>
      <th>Sikap jaksa:</th>
      <td><?php echo $pdm_upaya_banding->getSikapJaksa() ?></td>
    </tr>
    <tr>
      <th>Sikap terdakwa:</th>
      <td><?php echo $pdm_upaya_banding->getSikapTerdakwa() ?></td>
    </tr>
    <tr>
      <th>Pj pidana coba thn:</th>
      <td><?php echo $pdm_upaya_banding->getPjPidanaCobaThn() ?></td>
    </tr>
    <tr>
      <th>Pj pidana coba bln:</th>
      <td><?php echo $pdm_upaya_banding->getPjPidanaCobaBln() ?></td>
    </tr>
    <tr>
      <th>Pj pidana coba hari:</th>
      <td><?php echo $pdm_upaya_banding->getPjPidanaCobaHari() ?></td>
    </tr>
    <tr>
      <th>Idoff:</th>
      <td><?php echo $pdm_upaya_banding->getIdoff() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('dnttest/edit?id='.$pdm_upaya_banding->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('dnttest/index') ?>">List</a>
