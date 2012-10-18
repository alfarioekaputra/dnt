<h1>Pdm upaya bandin gs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>No akta</th>
      <th>Tgl akta</th>
      <th>No memori</th>
      <th>Tgl memori</th>
      <th>Isi memori</th>
      <th>No putusan</th>
      <th>Tgl putusan</th>
      <th>Isi putusan</th>
      <th>Id tersangka</th>
      <th>Jenis putusan</th>
      <th>Pj pidana coba</th>
      <th>Pj masa coba</th>
      <th>Pj badan tahun</th>
      <th>Pj badan bulan</th>
      <th>Pj badan hari</th>
      <th>Pj denda rp</th>
      <th>Pj sub tahun</th>
      <th>Pj sub bulan</th>
      <th>Pj sub hari</th>
      <th>Pj biaya</th>
      <th>Kurungan tahun</th>
      <th>Kurungan bulan</th>
      <th>Kurungan hari</th>
      <th>Denda</th>
      <th>Putusan tambahan</th>
      <th>Sikap jaksa</th>
      <th>Sikap terdakwa</th>
      <th>Pj pidana coba thn</th>
      <th>Pj pidana coba bln</th>
      <th>Pj pidana coba hari</th>
      <th>Idoff</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pdm_upaya_bandin_gs as $pdm_upaya_banding): ?>
    <tr>
      <td><a href="<?php echo url_for('dnttest/show?id='.$pdm_upaya_banding->getId()) ?>"><?php echo $pdm_upaya_banding->getId() ?></a></td>
      <td><?php echo $pdm_upaya_banding->getNama() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('dnttest/new') ?>">New</a>
