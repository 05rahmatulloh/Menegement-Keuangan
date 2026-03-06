




<?php
include "config/database.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM transaksi WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$kategori = $_POST['kategori'];
$jenis = $_POST['jenis'];
$jumlah = $_POST['jumlah'];

mysqli_query($conn,"UPDATE transaksi SET
tanggal='$tanggal',
keterangan='$keterangan',
kategori='$kategori',
jenis='$jenis',
jumlah='$jumlah'
WHERE id='$id'
");

header("Location: index.php");
}
?>






<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        /* HEADER */

        header {
            background: #0096C7;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            color: #CAF0F8;
            font-size: 20px;
        }

        nav a {
            text-decoration: none;
            margin-left: 15px;
            color: #CAF0F8;
            font-weight: 600;
        }

        /* BODY */

        body {
            background: linear-gradient(135deg, #CAF0F8, #90E0EF);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* MAIN CONTENT */

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #023E8A;
        }

        /* FORM */

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        input:focus,
        select:focus {
            border-color: #00B4D8;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 180, 216, 0.3);
        }

        /* BUTTON */

        button {
            width: 100%;
            padding: 12px;
            background: #00B4D8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            background: #0096C7;
        }

        /* BACK BUTTON */

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 12px;
            padding: 10px;
            background: #CAF0F8;
            border-radius: 8px;
            text-decoration: none;
            color: #023E8A;
            font-weight: 600;
        }

        .back-btn:hover {
            background: #90E0EF;
        }

        /* FOOTER */

        footer {
            background: #0096C7;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #CAF0F8;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        /* RESPONSIVE */

        @media (max-width:600px) {

            header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .container {
                padding: 20px;
            }

        }
    </style>
</head>

<body>

    <!-- HEADER -->

    <header>

        <h1>Personal Finance App</h1>

        <nav>
            <a href="index.php">Dashboard</a>
            <a href="tambah_transaksi.php">Tambah Transaksi</a>
        </nav>

    </header>


    <!-- MAIN -->

    <main>

        <div class="container">

            <h2>Edit Transaksi</h2>

            <form>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="<?php echo $row['tanggal']; ?>">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                   <input type="text" name="keterangan" value="<?php echo $row['keterangan']; ?>">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                   <input type="text" name="kategori" value="<?php echo $row['kategori']; ?>">
                </div>

                <div class="form-group">
                    <label>Jenis</label>
                    <select>
                        <option>Pemasukan</option>
                        <option>Pengeluaran</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" value="<?php echo $row['jumlah']; ?>">
                </div>

               <button type="submit" name="update">Update Transaksi</button>

                <a href="index.php" class="back-btn">Kembali ke Dashboard</a>

            </form>

        </div>

    </main>


    <!-- FOOTER -->

    <footer>

        <p>© 2026 Personal Finance App | Sistem Keuangan Pribadi</p>

    </footer>

</body>

</html>