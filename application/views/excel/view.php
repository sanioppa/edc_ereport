<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title><?php echo $title ?></title>
 <style type="text/css">
 body {
 background-color: green;
 font-family: Arial;
 }
 main {
 width: 80%;
 padding: 20px;
 background-color: white;
 min-height: 300px;
 border-radius: 5px;
 margin: 30px auto;
 }
 table {
 border-top: solid thin #000;
 border-collapse: collapse;
 }
 th, td {
 border-top: border-top: solid thin #000;
 padding: 6px 12px;
 }
 </style>
</head>

<body>
 <main>
 <h1>Laporan Excel</h1>
 <p><a href="<?php echo base_url('excel/export_excel') ?>">Export ke Excel</a></p>
 <table border="1" width="100%">
 <thead>
 <tr>
 <th>Nama</th>
 <th>Username</th>
 <th>Password</th>
 </tr>
 </thead>
 <tbody>
 <?php $i=1; foreach($user as $user) { ?>
 <tr>
 <td><?php echo $user->name ?></td>
 <td><?php echo $user->username ?></td>
 <td><?php echo $user->nip ?></td>
 </tr>
 <?php $i++; } ?>
 </tbody>
 </table>

<h1>Data Siswa</h1><hr>
<a href="<?php echo base_url("listuser/export"); ?>">Export ke Excel</a><br><br>
<table border="1" cellpadding="8">
<tr>
  <th>NIP</th>
  <th>Nama</th>
  <th>Username</th>
  <th>Password</th>
</tr>
<?php
if( ! empty($user)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
  foreach($user as $data){ // Lakukan looping pada variabel siswa dari controller
    echo "<tr>";
    echo "<td>".$data->nip."</td>";
    echo "<td>".$data->nama."</td>";
    echo "<td>".$data->username."</td>";
    echo "<td>".$data->password."</td>";
    echo "</tr>";
  }
}else{ // Jika data tidak ada
  echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>


 </main>
</body>
</html>