<h1>Pdm barbu ks List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id perkara</th>
      <th>Nama</th>
      <th>Jumlah</th>
      <th>Pemilik</th>
      <th>Eksekusi</th>
      <th>Id satuan</th>
      <th>Tgl eksekusi</th>
      <th>Idoff</th>
      <th>Eksekusi rentut</th>
      <th>Eksekusi rentut jaksapu</th>
      <th>Eksekusi rentut kasipidum</th>
      <th>Eksekusi rentut kejari</th>
      <th>Eksekusi rentut kejati</th>
      <th>Eksekusi rentut kejagung</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pdm_barbu_ks as $pdm_barbuk): ?>
    <tr>
      <td><a href="<?php echo url_for('barangRampasan/show?id='.$pdm_barbuk->getId()) ?>"><?php echo $pdm_barbuk->getId() ?></a></td>
      <td><?php echo $pdm_barbuk->getIdPerkara() ?></td>
      <td><?php echo $pdm_barbuk->getNama() ?></td>
      <td><?php echo $pdm_barbuk->getJumlah() ?></td>
      <td><?php echo $pdm_barbuk->getPemilik() ?></td>
      <td><?php echo $pdm_barbuk->getEksekusi() ?></td>
      <td><?php echo $pdm_barbuk->getIdSatuan() ?></td>
      <td><?php echo $pdm_barbuk->getTglEksekusi() ?></td>
      <td><?php echo $pdm_barbuk->getIdoff() ?></td>
      <td><?php echo $pdm_barbuk->getEksekusiRentut() ?></td>
      <td><?php echo $pdm_barbuk->getEksekusiRentutJaksapu() ?></td>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKasipidum() ?></td>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKejari() ?></td>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKejati() ?></td>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKejagung() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('barangRampasan/new') ?>">New</a>
