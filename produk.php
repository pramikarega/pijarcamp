<?php
include "databaseKoneksi.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PIJARCAMP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

  <body>

    <div class="container">

        <div class="mt-3">
            <h3 class="text-center">CRUD Produk Penjualan</h3>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Data Produk Penjualan
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Data
                </button>

                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                    //perispan menampilkan data dari mysql
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY nama_produk DESC");
                    while($data = mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                           <td><?= $no++ ?></td>
                           <td><?= $data['nama_produk'] ?></td>
                           <td><?= $data['keterangan'] ?></td>  
                           <td><?= $data['harga'] ?></td>
                           <td><?= $data['jumlah'] ?></td>
                           <td>
                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Ubah</a>  
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                           </td>
                        </tr>

                        <!-- Awal Modal Ubah -->
                        <div class="modal fade" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Ubah Data Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form method="POST" action="simpanDtbs.php">
                                        <input type="hidden" name="ID" value="<?= $data['ID'] ?>">
                                        <div class="modal-body">
                                        

                                            <div class="mb-3">
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" name="fname"  value="<?=$data['nama_produk']?>"
                                                placeholder="Masukkan Nama Produk">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan"  value="<?=$data['keterangan']?>"
                                                placeholder="Masukkan Keterangan Produk">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Harga</label>
                                                <input type="text" class="form-control" name="harga"  value="<?=$data['harga']?>" 
                                                placeholder="Masukkan Harga Produk">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Jumlah</label>
                                                <input type="text" class="form-control" name="jumlah"  value="<?=$data['jumlah']?>"
                                                placeholder="Masukkan Jumlah Produk">
                                            </div>
                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="bubah">Ubah</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal Ubah-->


                        <!-- Awal Modal Hapus -->
                        <div class="modal fade-lg" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form method="POST" action="simpanDtbs.php">
                                        <input type="hidden" name="ID" value="<?= $data['ID'] ?>">
                                        
                                        <div class="modal-body">
                                        
                                        <h5 class="text-center"> Apakah anda yakin akan menghapus data ini? <br>
                                            <span class="text-danger"><?=$data['nama_produk']?> </span>
                                        </h5>
                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="bhapus">Ya, Hapus</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal Hapus-->



                    <?php
                    }
                    ?>
                </table>

                
                <!-- Awal Modal -->
                <div class="modal fade-lg" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Data Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form method="POST" action="simpanDtbs.php">
                                <div class="modal-body">
                                

                                    <div class="mb-3">
                                        <label class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" name="fname"  placeholder="Masukkan Nama Produk">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan"  placeholder="Masukkan Keterangan Produk">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Harga</label>
                                        <input type="text" class="form-control" name="harga"  placeholder="Masukkan Harga Produk">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="text" class="form-control" name="jumlah"  placeholder="Masukkan Jumlah Produk">
                                    </div>
            
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>

                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal -->


            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>