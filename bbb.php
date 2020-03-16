<?php

$koneksi = mysqli_connect("localhost","root","","nilai");

if (mysqli_connect_errno()){
echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body class="container-fluid" style="margin: 40px 80px">
	<form name="form-1" method="POST">
		<h2>Penjumlahan Beruntun</h2>
		Nilai 1 : <input type="number" name="a"><br>
		Nilai 2 : <input type="number" name="b"><br>
		<input type="submit" name="submit" value="submit">
		
		<?php
		if(isset($_POST['submit'])){
			$a=$_POST['a'];
			$b=$_POST['b'];
			$c=$a+$b;

			if($c<=0){
				$keterangan='D';
			} elseif($c>>0){
				$keterangan='A';
			}elseif($c>>10) {
				$keterangan='B';

			} elseif($c>>10) {
				$keterangan='C';

			}
			for($i=0;$i<=2;$i++){
				$a=$b;
				$b=$c;
				$c=$a+$b;
				if($c<=0){
					$keterangan='D';
				} elseif($c>>0){
					$keterangan='A';
				}elseif($c>>10) {
					$keterangan='B';

				} elseif($c>>10) {
					$keterangan='C';

				}
				$sql = mysqli_query($koneksi, "INSERT INTO tb_nilai (nilai_a, nilai_b, nilai_c,nilai_keterangan) VALUES('$a', '$b', '$c','$keterangan')") or die(mysqli_error($koneksi));

			}
			/*$sql = mysqli_query($koneksi, "INSERT INTO tb_nilai (nilai_a, nilai_b, nilai_c,nilai_keterangan) VALUES('$a', '$b', '$c','$keterangan')") or die(mysqli_error($koneksi));*/
			echo "<br><input type='text' value=$c>";
		}

		?>
		
	</form>
	<br>
	<table border="1px">
		<thead>
		<tr>
			<td>ID</td>
			<td>Nilai 1</td>
			<td>Nilai 2</td>
			<td>Hasil Penjumlahan</td>
			<td>Keterangan</td>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = mysqli_query($koneksi, "Select * from tb_nilai");
		if(mysqli_num_rows($sql) > 0){
			$no = 1;
			while($data = mysqli_fetch_assoc($sql)){
				echo '
				<tr>
				<td>'.$no.'</td>
				<td>'.$data['nilai_a'].'</td>
				<td>'.$data['nilai_b'].'</td>
				<td>'.$data['nilai_c'].'</td>
				<td>'.$data['nilai_keterangan'].'</td>
				
				</tr>
				';

				$no++;
				}
				//jika query menghasilkan nilai 0
				}else{
				echo '
				<tr>
				<td colspan="5">Tidak ada data.</td>
				</tr>
				';
				}
			
		?>
	</tbody>
	</table>

</body>
</html>
