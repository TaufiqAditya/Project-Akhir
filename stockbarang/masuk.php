<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand" href="home.php">Taufiq Aditya Putra</a>
            
        </nav>
        <br>
        <br>
        <br>
        <h1>LABORATORIUM INFORMATIKA</h1>
        <table width="100%" cellspacing="0">
<th>
                        <ul class="nav nav-tabs justify-content">
                            <li class="nav-item">
                            <a class="nav-link active" href="index.php">Stock Barang</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link active" href="masuk.php">Barang Masuk</a>
                            </li>

                            <li class="nav-item">
                            <a class="nav-link active" href="keluar.php">Barang Keluar</a>
                            </li>
                            
                            <li class="nav-item">
                            <a class="nav-link active" href="logout.php">Logout</a>
                            </li> 
                        </ul>   

                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
</th>
<th>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Barang Masuk</h1>
</th>
        </table>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal">
                                        Tambah barang
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <tbody>
                          
                                            <?php
                                            $ambilsemuadatastock = mysqli_query($conn,"select * from masuk m, stock s where s.idbarang = m.idbarang");
                                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $idb = $data['idbarang'];
                                                $idm = $data['idmasuk'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];
                                            
                                            ?>

                                            <tr>
                                                <td>

                                                <?php

                                                $tanggal=date('j F Y');
                                                $tz = 'Asia/Jakarta';
                                                $dt = new DateTime("now", new DateTimeZone($tz));
                                                $timestamp = $dt->format('G:i');
                                                echo "$tanggal pukul $timestamp WIB\n";

                                                ?>

                                             
                                                </td>
                                                
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit<?=$idm;?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete<?=$idm;?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idm;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                              
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                            </div>
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                            </div>
                                            </div>


                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?=$idm;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                              
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Barang?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus <?=$namabarang;?>
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                                            </div>
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                            </div>


                                            <?php
                                            };
                                            ?>

                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright 2000018201&copy; Taufiq Aditya Putra 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">

                        <select name="barangnya" class="form-control">
                            <?php
                                $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
                                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                    $namabarangnya = $fetcharray['namabarang'];
                                    $idbarangnya = $fetcharray['idbarang'];

                            ?>

                            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                            <?php
                                }

                            ?>
                        </select>
                        <br>
                        <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
                        <br>
                        <input type="text" name="penerima" placeholder="penerima" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                    </div>
                </form>
        
            </div>
        </div>
    </div>
</html>