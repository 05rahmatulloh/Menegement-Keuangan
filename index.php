<?php
include "config/database.php";

$query = mysqli_query($conn,"SELECT * FROM transaksi ORDER BY tanggal DESC");

$pemasukan = mysqli_query($conn,"SELECT SUM(jumlah) as total FROM transaksi WHERE jenis='pemasukan'");
$data_pemasukan = mysqli_fetch_assoc($pemasukan);

$pengeluaran = mysqli_query($conn,"SELECT SUM(jumlah) as total FROM transaksi WHERE jenis='pengeluaran'");
$data_pengeluaran = mysqli_fetch_assoc($pengeluaran);

$total_saldo = $data_pemasukan['total'] - $data_pengeluaran['total'];
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlow | Personal Finance Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #0077B6;
            --secondary: #90E0EF;
            --success: #2ECC71;
            --danger: #E74C3C;
            --dark: #03045E;
            --light: #F8F9FA;
            --bg: #CAF0F8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #CAF0F8 0%, #ADE8F4 100%);
            margin: 0;
            padding: 40px 20px;
            color: #333;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header h1 {
            color: var(--dark);
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 5px;
        }

        header p {
            color: var(--primary);
            opacity: 0.8;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover { transform: translateY(-5px); }

        .card h3 {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card .amount {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 10px 0;
            color: var(--dark);
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--dark); box-shadow: 0 5px 15px rgba(0,119,182,0.4); }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .filter-group { display: flex; flex-direction: column; gap: 5px; }
        
        .filter-group label { font-size: 0.85rem; font-weight: 600; color: #555; }

        input, select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
        }

        /* Table Design */
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #F1F5F9;
            padding: 15px;
            text-align: left;
            font-size: 0.9rem;
            color: #666;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
        }

        .tag {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .tag-pemasukan { background: #D4EDDA; color: var(--success); }
        .tag-pengeluaran { background: #F8D7DA; color: var(--danger); }

        .btn-icon {
            color: #999;
            margin: 0 5px;
            transition: color 0.3s;
        }

        .btn-edit:hover { color: var(--primary); }
        .btn-delete:hover { color: var(--danger); }

    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>FinanceFlow</h1>
        <p>Kelola keuanganmu dengan lebih cerdas dan terukur.</p>
    </header>

    <div class="dashboard-grid">
        <div class="card">
            <h3>Total Saldo</h3>
            <div class="amount" style="color: var(--primary);">Rp <?php echo number_format($total_saldo); ?></div>
            <small><i class="fas fa-arrow-up" style="color: var(--success);"></i> +2.5% dari bulan lalu</small>
        </div>
        <div class="card">
            <h3>Pemasukan</h3>
           <div class="amount" style="color: var(--success);">
               Rp <?php echo number_format($total_pemasukan,0,',','.'); ?>
           </div>
        </div>
        <div class="card">
            <h3>Pengeluaran</h3>
            <div class="amount" style="color: var(--danger);">
                Rp <?php echo number_format($total_pengeluaran,0,',','.'); ?>
            </div>
        </div>
    </div>

    <div class="action-bar">
        <a href="tambah_transaksi.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Transaksi
        </a>
        
        <div class="filter-section">
            <div class="filter-group">
                <label>Tanggal</label>
                <input type="date">
            </div>
            <div class="filter-group">
                <label>Kategori</label>
                <select>
                    <option>Semua Kategori</option>
                    <option>Makanan</option>
                    <option>Transport</option>
                    <option>Hiburan</option>
                </select>
            </div>
            <button class="btn btn-primary" style="padding: 10px 20px;">Filter</button>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

<?php
$no = 1;
while($row = mysqli_fetch_assoc($query)){
?>

<tr>
<td><?php echo $no++; ?></td>

<td><?php echo $row['tanggal']; ?></td>

<td>
<strong><?php echo $row['keterangan']; ?></strong>
<br>
<small style="color:#999">Kategori: <?php echo $row['kategori']; ?></small>
</td>

<td>
<?php if($row['jenis']=="pemasukan"){ ?>
<span class="tag tag-pemasukan">Pemasukan</span>
<?php }else{ ?>
<span class="tag tag-pengeluaran">Pengeluaran</span>
<?php } ?>
</td>

<td style="font-weight:bold;">
Rp <?php echo number_format($row['jumlah']); ?>
</td>

<td>
<a href="edit_transaksi.php?id=<?php echo $row['id']; ?>" class="btn-icon btn-edit">
<i class="fas fa-edit"></i>
</a>

<a href="hapus_transaksi.php?id=<?php echo $row['id']; ?>" class="btn-icon btn-delete">
<i class="fas fa-trash"></i>
</a>
</td>

</tr>

<?php } ?>

</tbody>
        </table>
    </div>
</div>

</body>
</html>