<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $pdm_barbuk->getId() ?></td>
    </tr>
    <tr>
      <th>Id perkara:</th>
      <td><?php echo $pdm_barbuk->getIdPerkara() ?></td>
    </tr>
    <tr>
      <th>Nama:</th>
      <td><?php echo $pdm_barbuk->getNama() ?></td>
    </tr>
    <tr>
      <th>Jumlah:</th>
      <td><?php echo $pdm_barbuk->getJumlah() ?></td>
    </tr>
    <tr>
      <th>Pemilik:</th>
      <td><?php echo $pdm_barbuk->getPemilik() ?></td>
    </tr>
    <tr>
      <th>Eksekusi:</th>
      <td><?php echo $pdm_barbuk->getEksekusi() ?></td>
    </tr>
    <tr>
      <th>Id satuan:</th>
      <td><?php echo $pdm_barbuk->getIdSatuan() ?></td>
    </tr>
    <tr>
      <th>Tgl eksekusi:</th>
      <td><?php echo $pdm_barbuk->getTglEksekusi() ?></td>
    </tr>
    <tr>
      <th>Idoff:</th>
      <td><?php echo $pdm_barbuk->getIdoff() ?></td>
    </tr>
    <tr>
      <th>Eksekusi rentut:</th>
      <td><?php echo $pdm_barbuk->getEksekusiRentut() ?></td>
    </tr>
    <tr>
      <th>Eksekusi rentut jaksapu:</th>
      <td><?php echo $pdm_barbuk->getEksekusiRentutJaksapu() ?></td>
    </tr>
    <tr>
      <th>Eksekusi rentut kasipidum:</th>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKasipidum() ?></td>
    </tr>
    <tr>
      <th>Eksekusi rentut kejari:</th>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKejari() ?></td>
    </tr>
    <tr>
      <th>Eksekusi rentut kejati:</th>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKejati() ?></td>
    </tr>
    <tr>
      <th>Eksekusi rentut kejagung:</th>
      <td><?php echo $pdm_barbuk->getEksekusiRentutKejagung() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('barangRampasan/edit?id='.$pdm_barbuk->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('barangRampasan/index') ?>">List</a>
