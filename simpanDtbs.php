<?php
//memanggil koneksi database
include "databaseKoneksi.php";

//tombol simpan di-klik
if (isset($_POST['bsimpan'])) {

    // simpan data baru
    $query = "INSERT INTO produk(nama_produk, keterangan, harga, jumlah) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssss", $_POST['fname'], $_POST['keterangan'], $_POST['harga'], $_POST['jumlah']);

        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        // jika simpan data sukses
        if ($success) {
            echo "<script>
            alert('Simpan Data Sukses!');
            document.location='produk.php';
            </script>";
        } else {
            echo "<script>
            alert('Simpan Data Gagal!');
            document.location='produk.php';
            </script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the error if preparing the statement fails
        echo "Error: " . mysqli_error($koneksi);
    }
}                               

//tombol ubah di-klik
if (isset($_POST['bubah'])) {

    // ubah data baru
    $ubah = "UPDATE produk SET
                                            nama_produk = ?,
                                            keterangan = ?,
                                            harga = ?,
                                            jumlah = ?
                                        WHERE ID = ?";
    
    $stmt = mysqli_prepare($koneksi, $ubah);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sssss", $_POST['fname'], $_POST['keterangan'], $_POST['harga'], $_POST['jumlah'], $_POST['ID']);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // jika simpan data sukses
        if ($ubah) {
            echo "<script>
            alert('Ubah Data Sukses!');
            document.location='produk.php';
            </script>";
        } else {
            echo "<script>
            alert('Ubah Data Gagal!');
            document.location='produk.php';
            </script>";
        }
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the error if preparing the statement fails
        echo "Error: " . mysqli_error($koneksi);
    }
}        

//tombol hapus di-klik
if (isset($_POST['bhapus'])) {

    // persiapan hapus data
    $hapus = "DELETE FROM produk WHERE ID = ?";
    
    $stmt = mysqli_prepare($koneksi, $hapus);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "s", $_POST['ID']);

        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        // jika hapus data sukses
        if ($success) {
            echo "<script>
            alert('Hapus Data Sukses!');
            document.location='produk.php';
            </script>";
        } else {
            echo "<script>
            alert('Hapus Data Gagal!');
            document.location='produk.php';
            </script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the error if preparing the statement fails
        echo "Error: " . mysqli_error($koneksi);
    }        
}


// Close the database connection
mysqli_close($koneksi);
?>
