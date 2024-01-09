<?php
session_start();
//membuat koneksi database
$conn = mysqli_connect("localhost", "root", "", "webbangtkj1");



//proses LOGIN
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM biodataasesi WHERE username='$username' and password='$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $data = mysqli_fetch_assoc($cekdatabase);
        // buat session login dan user ID (or any other unique identifier)
        $_SESSION['user_id'] = $data['id'];
        header("location: asesi_apl01.php");
    } else {
        echo 'Username / Password Salah';
        header("location: index.php");
    }
}




//proses LOGIN bng
if (isset($_POST['logindua'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $cekdatabase = mysqli_query($conn, "SELECT * FROM biodataasesor WHERE username='$username' and password='$password'");
    //hitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {

        $data = mysqli_fetch_assoc($cekdatabase);
        // cek jika user login sebagai admin
        if ($data['tuk'] == "Admin") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "Admin";
            // alihkan ke halaman dashboard admin
            header("location:menu_asesor.php");

        } else if ($data['tuk'] == "TBSM") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "TBSM";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");

            // cek jika user login sebagai pegawai
        } else if ($data['tuk'] == "Teknik Komputer dan Jaringan") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "Teknik Komputer dan Jaringan";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");

            // cek jika user login sebagai pegawai
        } else if ($data['tuk'] == "DPIB") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "DPIB";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");

            // cek jika user login sebagai pegawai
        } else if ($data['tuk'] == "TP") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "TP";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");
        
            // cek jika user login sebagai pegawai
        } else if ($data['tuk'] == "TEI") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "TEI";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");

            // cek jika user login sebagai pegawai
        } else if ($data['tuk'] == "TLAS") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "TLAS";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");

            // cek jika user login sebagai pegawai
        } else if ($data['tuk'] == "TMI") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "TMI";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");

            // cek jika user login sebagai pegawai
        } else if ($data['tuk'] == "TKR") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['tuk'] = "TKR";
            // alihkan ke halaman dashboard pegawai
            header("location:asesor_tkj.php");
        
        } else {


            // alihkan ke halaman login kembali
            echo 'Username / Password Salah';
            header("location:index.php");
        }

    } else {
        header('location:index.php');
    }
}





//menambahkan alat
if (isset($_POST['tambahkan'])) {
    $kode_alat = $_POST['kode_alat'];
    $nama_alat = $_POST['nama_alat'];
    $spek = $_POST['spek'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];
    $kondisi = $_POST['kondisi'];
    $merek = $_POST['merek'];


    $lokasi = $_POST['lokasi'];

    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ngambil ekstensti
    $ukuran = $_FILES['file']['size']; //ngambil size 
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi file

    //penamaan file ->> enkripsi nama file
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dengn ekstensi

    //validasi alat sudah ada ato blm
    $cek = mysqli_query($conn, "SELECT * FROM stock WHERE kode_alat='$kode_alat'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung < 1) {
        //jika blm
        //proses upload gambar
        if (in_array($ekstensi, $allowed_extension) === true) {
            //validasi ukuran filenya
            if ($ukuran < 5000000) {
                move_uploaded_file($file_tmp, 'images/' . $image);

                $addto = mysqli_query($conn, "INSERT into stock (kode_alat, nama_alat, merek, spek, jumlah, satuan, kondisi, image, lokasi) VALUE ('$kode_alat', '$nama_alat', '$merek', '$spek', '$jumlah', '$satuan', '$kondisi', '$image', '$lokasi')");
                if ($addto) {
                    header('location:data_alat.php');
                } else {
                    echo 'Gagal bng';
                }
            } else {
                // jika lebih dari 10mb
                echo '
                <script>
                    alert("Ukuran file terlalu besar");
                    window.location.href="data_alat.php";
                </script>';
            }
        } else {
            //kalu filenya tidak png/jpg
            echo '
        <script>
            alert("File Harus PNG / JPG");
            window.location.href="data_alat.php";
        </script>';
        }
    } else {
        // jika sudahg
        echo '
        <script>
            alert("Alat Sudah Terdaftar");
            window.location.href="data_alat.php";
        </script>';
    }



}


//menambahkan alat masuk
if (isset($_POST['input'])) {
    $alattkj = $_POST['alattkj'];
    $qty = $_POST['qty'];
    $operator = $_POST['operator'];

    $cekalatsekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$alattkj'");
    $datanya = mysqli_fetch_array($cekalatsekarang);

    $datasekarang = $datanya['jumlah'];
    $tambahjumlahalat = $datasekarang + $qty;

    $addtoinput = mysqli_query($conn, "INSERT INTO input_alat (idalat, qty, operator) values('$alattkj', '$qty', '$operator')");
    $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$tambahjumlahalat' WHERE idalat ='$alattkj'");

    if ($addtoinput && $updatealat) {
        header('location:input_alat.php');
    } else {
        echo 'Gagal Menambahkan Data';
        header('location:input_alat.php');
    }

}


//menambahkan alat dipinjam
if (isset($_POST['pinjam'])) {
    $alattkj = $_POST['alattkj'];
    $qty_pinjam = $_POST['qty_pinjam'];
    $nama = $_POST['nama'];


    $cekalatsekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$alattkj'");
    $datanya = mysqli_fetch_array($cekalatsekarang);

    $datasekarang = $datanya['jumlah'];

    if ($datasekarang > $qty_pinjam) {
        $tambahjumlahalat = $datasekarang - $qty_pinjam;

        $addtopinjam = mysqli_query($conn, "INSERT INTO pinjam_bang (idalat, qty_pinjam, nama) values('$alattkj', '$qty_pinjam', '$nama')");
        $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$tambahjumlahalat' WHERE idalat ='$alattkj'");

        if ($addtopinjam && $updatealat) {
            echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
            header('location:pinjam_alat.php');
        } else {
            echo 'Gagal Menambahkan Data';

        }
    } else {
        // kalo alat ga cukup
        echo '
        <script>
            alert("Jumlah Alat saat ini tidak MENCUKUPI");
            window.location.href=pinjam_alat.php
        </script>';

    }
}


// Ubah ingfo dangta alatsu
if (isset($_POST['ubahalat'])) {
    $idnya = $_POST['idalat'];
    $kode = $_POST['kode_alat'];
    $namaalat = $_POST['nama_alat'];
    $spek = $_POST['spek'];
    $kondisinya = $_POST['kondisi'];
    $gambar = $_POST['image'];
    $alamak = $_POST['lokasi'];
    $merekalat = $_POST['merek'];

    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ngambil ekstensti
    $ukuran = $_FILES['file']['size']; //ngambil size 
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi file

    //penamaan file ->> enkripsi nama file
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dengn ekstensi

    $cek = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$idnya'");
    $hitung = mysqli_num_rows($cek);


    if ($ukuran == 0) {

        //jika tidak ingin uploaf
        $update = mysqli_query($conn, "UPDATE stock set kode_alat='$kode', nama_alat='$namaalat', spek='$spek', kondisi='$kondisinya', merek='$merekalat' , lokasi='$alamak'  WHERE idalat='$idnya'");
        if ($update) {
            header('location:data_alat.php');
        } else {
            echo 'Gagal BRuhhhh';
            header('location:data_alat.php');
        }

    } else {
        // jika iya
        move_uploaded_file($file_tmp, 'images/' . $image);
        $update = mysqli_query($conn, "UPDATE stock set kode_alat='$kode', nama_alat='$namaalat',  merek='$merekalat', spek='$spek', kondisi='$kondisinya', image='$image', lokasi='$alamak' WHERE idalat='$idnya'");
        if ($update) {
            header('location:data_alat.php');
        } else {
            echo 'Gagal BRuhhhh';
            header('location:data_alat.php');
        }
    }


}


//hapus data alat dari EKSISTENSI!!!
if (isset($_POST['hapusalat'])) {
    $idnya = $_POST['idalat'];

    $gambar = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$idnya'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/' . $get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "DELETE from stock WHERE idalat='$idnya'");
    if ($hapus) {
        header('location:data_alat.php');
    } else {
        echo 'Gagal BRuhhhh';
        header('location:data_alat.php');
    }
}


//hapus riwayat pinjemm alat dari EKSISTENSI!!!
if (isset($_POST['hapushistori'])) {
    $idpinj  = $_POST['id_pinjam'];

    $hapus = mysqli_query($conn, "DELETE from pinjam_bang WHERE id_pinjam='$idpinj '");
    if ($hapus) {
        header('location:liatriwayat.php');
    } else {
        echo 'Gagal BRuhhhh';
        header('location:liatriwayat.php');
    }
}


//Tambahin USer bngggg
if (isset($_POST['upload'])) {
    $username = $_POST['username'];
    $fullname = $_POST['first_name'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];
    $level = $_POST['user_type'];


    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ngambil ekstensti
    $ukuran = $_FILES['file']['size']; //ngambil size 
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi file

    //penamaan file ->> enkripsi nama file
    $foto = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dengn ekstensi

    //validasi alat sudah ada ato blm
    $cek = mysqli_query($conn, "SELECT * FROM tkj WHERE username='$username'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung < 1) {
        //jika blm
        //proses upload gambar
        if (in_array($ekstensi, $allowed_extension) === true) {
            //validasi ukuran filenya
            if ($ukuran < 5000000) {
                move_uploaded_file($file_tmp, 'poto/' . $foto);

                $addto = mysqli_query($conn, "INSERT into tkj (username, first_name, password, kelas, photo, user_type) VALUE ('$username', '$fullname', '$password', '$kelas', '$foto', '$level')");
                if ($addto) {
                    header('location:tabeluser.php');
                } else {
                    echo 'Gagal bng';
                }
            } else {
                // jika lebih dari 10mb
                echo '
                <script>
                    alert("Ukuran file terlalu besar");
                    window.location.href="tabeluser.php";
                </script>';
            }
        } else {
            //kalu filenya tidak png/jpg
            echo '
        <script>
            alert("File Harus PNG / JPG");
            window.location.href="tabeluser.php";
        </script>';
        }
    } else {
        // jika sudahg
        echo '
        <script>
            alert("Alat Sudah Terdaftar");
            window.location.href="tabeluser.php";
        </script>';
    }

}



// Cek apakah tombol submit dengan nama 'nilaitkj' telah diklik
if (isset($_POST['nilaitkj'])) {
   
    // Mengambil nilai catatan dan hasil dari formulir
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $catatan4 = $_POST['catatan4'];
    $catatan5 = $_POST['catatan5'];
    $catatan6 = $_POST['catatan6'];
    $catatan7 = $_POST['catatan7'];
    $catatan8 = $_POST['catatan8'];
    $catatan9 = $_POST['catatan9'];
    $catatan10 = $_POST['catatan10'];
    
    $hasil1 = (isset($_POST['hasil1'])) ? $_POST['hasil1'] : '';
    $hasil2 = (isset($_POST['hasil2'])) ? $_POST['hasil2'] : '';
    $hasil3 = (isset($_POST['hasil3'])) ? $_POST['hasil3'] : '';
    $hasil4 = (isset($_POST['hasil4'])) ? $_POST['hasil4'] : '';
    $hasil5 = (isset($_POST['hasil5'])) ? $_POST['hasil5'] : '';
    $hasil6 = (isset($_POST['hasil6'])) ? $_POST['hasil6'] : '';
    $hasil7 = (isset($_POST['hasil7'])) ? $_POST['hasil7'] : '';
    $hasil8 = (isset($_POST['hasil8'])) ? $_POST['hasil8'] : '';
    $hasil9 = (isset($_POST['hasil9'])) ? $_POST['hasil9'] : '';
    $hasil10 = (isset($_POST['hasil10'])) ? $_POST['hasil10'] : '';

    // Mengambil nilai id dari formulir
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaitkj WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaitkj (catatan1, catatan2, catatan3, catatan4, catatan5, catatan6, catatan7, catatan8, catatan9, catatan10, hasil1, hasil2, hasil3, hasil4, hasil5, hasil6, hasil7, hasil8, hasil9, hasil10, id) VALUES ('$catatan1', '$catatan2', '$catatan3', '$catatan4', '$catatan5', '$catatan6', '$catatan7', '$catatan8', '$catatan9', '$catatan10', '$hasil1', '$hasil2', '$hasil3', '$hasil4', '$hasil5', '$hasil6', '$hasil7', '$hasil8', '$hasil9', '$hasil10', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_tkj.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaitkj SET catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', catatan4='$catatan4', catatan5='$catatan5', catatan6='$catatan6', catatan7='$catatan7', catatan8='$catatan8', catatan9='$catatan9', catatan10='$catatan10', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3', hasil4='$hasil4', hasil5='$hasil5', hasil6='$hasil6', hasil7='$hasil7', hasil8='$hasil8', hasil9='$hasil9', hasil10='$hasil10' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_tkj.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}



// Ubah info Data Pengguna 
if (isset($_POST['nilaidpib'])) {
    $materi1 = $_POST['materi1'];
    $materi2 = $_POST['materi2'];
    $materi3 = $_POST['materi3'];
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $hasil1 = isset($_POST['kompeten1']) ? 'kompeten' : 'belum kompeten';
    $hasil2 = isset($_POST['kompeten2']) ? 'kompeten' : 'belum kompeten';
    $hasil3 = isset($_POST['kompeten3']) ? 'kompeten' : 'belum kompeten';
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaidpib WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaidpib ( catatan1, catatan2, catatan3, hasil1, hasil2, hasil3, id) VALUES ('$materi1', '$materi2', '$materi3', '$catatan1', '$catatan2', '$catatan3', '$hasil1', '$hasil2', '$hasil3', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_dpib.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaidpib SET materi1='$materi1', materi2='$materi2', materi3='$materi3', catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_dpib.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}

// Ubah info Data Pengguna 
if (isset($_POST['nilaitkr'])) {
    $materi1 = $_POST['materi1'];
    $materi2 = $_POST['materi2'];
    $materi3 = $_POST['materi3'];
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $hasil1 = isset($_POST['kompeten1']) ? 'kompeten' : 'belum kompeten';
    $hasil2 = isset($_POST['kompeten2']) ? 'kompeten' : 'belum kompeten';
    $hasil3 = isset($_POST['kompeten3']) ? 'kompeten' : 'belum kompeten';
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaitkr WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaitkr (materi1, materi2, materi3, catatan1, catatan2, catatan3, hasil1, hasil2, hasil3, id) VALUES ('$materi1', '$materi2', '$materi3', '$catatan1', '$catatan2', '$catatan3', '$hasil1', '$hasil2', '$hasil3', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_tkr.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaitkr SET materi1='$materi1', materi2='$materi2', materi3='$materi3', catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_tkr.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}

// Ubah info Data Pengguna 
if (isset($_POST['nilaitbsm'])) {
    $materi1 = $_POST['materi1'];
    $materi2 = $_POST['materi2'];
    $materi3 = $_POST['materi3'];
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $hasil1 = isset($_POST['kompeten1']) ? 'kompeten' : 'belum kompeten';
    $hasil2 = isset($_POST['kompeten2']) ? 'kompeten' : 'belum kompeten';
    $hasil3 = isset($_POST['kompeten3']) ? 'kompeten' : 'belum kompeten';
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaitbsm WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaitbsm (materi1, materi2, materi3, catatan1, catatan2, catatan3, hasil1, hasil2, hasil3, id) VALUES ('$materi1', '$materi2', '$materi3', '$catatan1', '$catatan2', '$catatan3', '$hasil1', '$hasil2', '$hasil3', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_tbsm.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaitbsm SET materi1='$materi1', materi2='$materi2', materi3='$materi3', catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_tbsm.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}

// Ubah info Data Pengguna 
if (isset($_POST['nilaitp'])) {
    $materi1 = $_POST['materi1'];
    $materi2 = $_POST['materi2'];
    $materi3 = $_POST['materi3'];
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $hasil1 = isset($_POST['kompeten1']) ? 'kompeten' : 'belum kompeten';
    $hasil2 = isset($_POST['kompeten2']) ? 'kompeten' : 'belum kompeten';
    $hasil3 = isset($_POST['kompeten3']) ? 'kompeten' : 'belum kompeten';
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaitp WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaitp (materi1, materi2, materi3, catatan1, catatan2, catatan3, hasil1, hasil2, hasil3, id) VALUES ('$materi1', '$materi2', '$materi3', '$catatan1', '$catatan2', '$catatan3', '$hasil1', '$hasil2', '$hasil3', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_tp.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaitp SET materi1='$materi1', materi2='$materi2', materi3='$materi3', catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_tp.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}

// Ubah info Data Pengguna 
if (isset($_POST['nilaitlas'])) {
    $materi1 = $_POST['materi1'];
    $materi2 = $_POST['materi2'];
    $materi3 = $_POST['materi3'];
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $hasil1 = isset($_POST['kompeten1']) ? 'kompeten' : 'belum kompeten';
    $hasil2 = isset($_POST['kompeten2']) ? 'kompeten' : 'belum kompeten';
    $hasil3 = isset($_POST['kompeten3']) ? 'kompeten' : 'belum kompeten';
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaitlas WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaitlas (materi1, materi2, materi3, catatan1, catatan2, catatan3, hasil1, hasil2, hasil3, id) VALUES ('$materi1', '$materi2', '$materi3', '$catatan1', '$catatan2', '$catatan3', '$hasil1', '$hasil2', '$hasil3', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_tlas.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaitlas SET materi1='$materi1', materi2='$materi2', materi3='$materi3', catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_tlas.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}

// Ubah info Data Pengguna 
if (isset($_POST['nilaitmi'])) {
    $materi1 = $_POST['materi1'];
    $materi2 = $_POST['materi2'];
    $materi3 = $_POST['materi3'];
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $hasil1 = isset($_POST['kompeten1']) ? 'kompeten' : 'belum kompeten';
    $hasil2 = isset($_POST['kompeten2']) ? 'kompeten' : 'belum kompeten';
    $hasil3 = isset($_POST['kompeten3']) ? 'kompeten' : 'belum kompeten';
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaitmi WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaitmi (materi1, materi2, materi3, catatan1, catatan2, catatan3, hasil1, hasil2, hasil3, id) VALUES ('$materi1', '$materi2', '$materi3', '$catatan1', '$catatan2', '$catatan3', '$hasil1', '$hasil2', '$hasil3', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_tmi.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaitmi SET materi1='$materi1', materi2='$materi2', materi3='$materi3', catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_tmi.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}

// Ubah info Data Pengguna 
if (isset($_POST['nilaielin'])) {
    $materi1 = $_POST['materi1'];
    $materi2 = $_POST['materi2'];
    $materi3 = $_POST['materi3'];
    $catatan1 = $_POST['catatan1'];
    $catatan2 = $_POST['catatan2'];
    $catatan3 = $_POST['catatan3'];
    $hasil1 = isset($_POST['kompeten1']) ? 'kompeten' : 'belum kompeten';
    $hasil2 = isset($_POST['kompeten2']) ? 'kompeten' : 'belum kompeten';
    $hasil3 = isset($_POST['kompeten3']) ? 'kompeten' : 'belum kompeten';
    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM nilaielin WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO nilaielin (materi1, materi2, materi3, catatan1, catatan2, catatan3, hasil1, hasil2, hasil3, id) VALUES ('$materi1', '$materi2', '$materi3', '$catatan1', '$catatan2', '$catatan3', '$hasil1', '$hasil2', '$hasil3', '$idu')");
        
        if ($insert) {
            header('location:asesor_form_elin.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE nilaielin SET materi1='$materi1', materi2='$materi2', materi3='$materi3', catatan1='$catatan1', catatan2='$catatan2', catatan3='$catatan3', hasil1='$hasil1', hasil2='$hasil2', hasil3='$hasil3' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_nilai_elin.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}
// Ubah info Data Pengguna 
if (isset($_POST['updateasesor'])) {
    $kodeasesor = $_POST['kode_asesor'];
    $nik = $_POST['nik'];
    $namasiswa = $_POST['nama'];
    $nomet = $_POST['nomet'];
    $jeniskelamin = $_POST['jenis_kelamin'];
    $kode = $_POST['username'];
    $password = $_POST['password'];
    $ttl = $_POST['ttl'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $kodepos = $_POST['kodepos'];
    $jabatan = $_POST['jabatan'];
    $lembaga = $_POST['lembaga'];
    $alamat_sekolah = $_POST['alamat_sekolah'];
    $kodepos_sekolah = $_POST['kodepos_sekolah'];
    $nohp_sekolah = $_POST['nohp_sekolah'];
    $email_sekolah = $_POST['email_sekolah'];

    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM biodataasesor WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO biodataasesor (kode_asesor, nik, nama, nomet, jenis_kelamin, username, password, ttl, nohp, alamat, kodepos, jabatan, id) VALUES ('$kodeasesor', '$nik', '$namasiswa', '$nomet', '$jeniskelamin', '$kode', '$password', '$ttl', '$nohp', '$alamat', '$kodepos', '$jabatan', '$idu')");
        
        if ($insert) {
            header('location:asesor_propile.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE biodataasesor SET kode_asesor='$kodeasesor', nik='$nik', nama='$namasiswa', nomet='$nomet', jenis_kelamin='$jeniskelamin', username='$kode', password='$password', ttl='$ttl', nohp='$nohp', alamat='$alamat', kodepos='$kodepos', jabatan='$jabatan' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesor_tkj.php');
            
        } else {
            echo 'Gagal Bro!';
        }
    }
    
}
// Ubah info Data Pengguna 
if (isset($_POST['updateasesi'])) {
    $kodeasesor = $_POST['kode_asesi'];
    $nik = $_POST['nik'];
    $namasiswa = $_POST['nama'];
    $nis = $_POST['nis'];
    $jeniskelamin = $_POST['jenis_kelamin'];
    $kode = $_POST['username'];
    $password = $_POST['password'];
    $ttl = $_POST['ttl'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $kodepos = $_POST['kodepos'];
    $lembaga = $_POST['lembaga'];
    $alamat_sekolah = $_POST['alamat_sekolah'];
    $kodepos_sekolah = $_POST['kodepos_sekolah'];
    $nohp_sekolah = $_POST['nohp_sekolah'];
    $email_sekolah = $_POST['email_sekolah'];

    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM biodataasesi WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO biodataasesi ( nik, nis, nama, email, jenis_kelamin, ttl, nohp, alamat, kodepos, jabatan, id) VALUES ( '$nik', '$nis' '$namasiswa', '$jeniskelamin', '$email', '$ttl', '$nohp', '$alamat', '$kodepos', '$idu')");
        
        if ($insert) {
            header('location:asesi_apl01.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE biodataasesi SET nik='$nik', email='$email',nama='$namasiswa', nis='$nis', jenis_kelamin='$jeniskelamin', ttl='$ttl', nohp='$nohp', alamat='$alamat', kodepos='$kodepos' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesi_apl01.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}



if (isset($_POST['cekcek'])) {
    $kk = isset($_POST['kk']) ? 1 : 0; // Set to 1 if checkbox is checked, 0 otherwise
    $rapor = isset($_POST['rapor']) ? 1 : 0;
    $sertifikat_pkl = isset($_POST['sertifikat_pkl']) ? 1 : 0;

    $idu = $_POST['id'];

    // Other fields
    // ...

    // Update data in the database
    $update = mysqli_query($conn, "UPDATE biodataasesi SET
        kk='$kk',
        rapor='$rapor',
        sertifikat_pkl='$sertifikat_pkl'
        WHERE id='$idu'");

    if ($update) {
        // Success
        header('location:asesi_apl01.php');
    } else {
        // Error
        echo 'Gagal Bro!';
    }
}

// Assuming your form is submitted using POST method
$tanggal_terpilih = isset($_GET['nama']) ? $_GET['nama'] : '';
$GATAU = isset($_GET['tuk']) ? $_GET['tuk'] : '';

if ($GATAU === 'Teknik Komputer dan Jaringan') {
    $table = 'nilaitkj';
    $jumlah_item = 10;
} elseif ($GATAU === 'TBSM') {
    $table = 'nilaitbsm';
    $jumlah_item = 35;
} elseif ($GATAU === 'TKR') {
    $table = 'nilaitkr';
    $jumlah_item = 21;
} elseif ($GATAU === 'DPIB') {
    $table = 'nilaidpib';
    $jumlah_item = 11;
} elseif ($GATAU === 'TP') {
    $table = 'nilaitp';
    $jumlah_item = 12;
} elseif ($GATAU === 'TMI') {
    $table = 'nilaitmi';
    $jumlah_item = 18;
} elseif ($GATAU === 'TLAS') {
    $table = 'nilaitlas';
    $jumlah_item = 17;
} elseif ($GATAU === 'TEI') {
    $table = 'nilaitei';
    $jumlah_item = 12;
} else {
    // Handle other cases or set a default table
    $table = 'nilaitkj';
}




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_data'])) {
    // Assuming you have a database connection already ($conn)
    
    // Sanitize and validate the data before using it in the query to prevent SQL injection
    $idu = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded file name
        $fotoName = basename($_FILES['foto']['name']);

        // Move the uploaded file to a specific folder
        $uploadDirectory = 'filephoto/'; // specify the folder where you want to store uploaded files
        $fotoPath = $uploadDirectory . $fotoName;

        // Move the uploaded file to the specified folder
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath)) {
            // Update the database with the new photo filename
            $updatePhotoQuery = "UPDATE nilaitkj SET foto='$fotoName' WHERE id='$idu'";
            mysqli_query($conn, $updatePhotoQuery);
        } else {
            // Handle file upload error
            echo "File upload failed.";
        }
    }
    // Loop through the form data
    for ($j = 1; $j <= $jumlah_item; $j++) {
        // Sanitize and validate other form fields as needed
        $hasil = isset($_POST['hasil' . $j]) ? mysqli_real_escape_string($conn, $_POST['hasil' . $j]) : '';
        $catatan = isset($_POST['catatan' . $j]) ? mysqli_real_escape_string($conn, $_POST['catatan' . $j]) : '';
        
        // Update the database with the form data
        $updateQuery = "UPDATE $table SET hasil$j = '$hasil', catatan$j = '$catatan' WHERE id = '$idu'";
        
        // Execute the query
        mysqli_query($conn, $updateQuery);
    }

    // Update the status in the database to 'ternilai'
    $updateStatusQuery = "UPDATE biodataasesi SET statusnilai = 'ternilai' WHERE nama = '$tanggal_terpilih'";
    mysqli_query($conn, $updateStatusQuery);

    // Redirect or display a success message after updating the data
    header("Location: asesor_nilai_tkj.php"); // Uncomment this line to redirect to a success page
    exit(); // Add this line to prevent further execution of the script
}



if (isset($_POST['ubahassesi'])) {
    // Sanitize and retrieve form data
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $namasiswa = mysqli_real_escape_string($conn, $_POST['nama']);
    $ttl = mysqli_real_escape_string($conn, $_POST['ttl']);
    $jeniskelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $kewarganegaraan = mysqli_real_escape_string($conn, $_POST['kewarganegaraan']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $kodepos = mysqli_real_escape_string($conn, $_POST['kodepos']);
    $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tuk = mysqli_real_escape_string($conn, $_POST['tuk']);
    $foto = $_FILES['foto']['name'];
    $idu = mysqli_real_escape_string($conn, $_POST['id']);

    // Update data in the database
    $update = mysqli_query($conn, "UPDATE biodataasesi SET
        nik='$nik',
        nis='$nis',
        nama='$namasiswa',
        ttl='$ttl',
        jenis_kelamin='$jeniskelamin',
        kewarganegaraan='$kewarganegaraan',
        alamat='$alamat',
        kodepos='$kodepos',
        nohp='$nohp',
        email='$email',
        tuk='$tuk'
        WHERE id='$idu'");

    if ($update) {
        // Upload new photo if provided
        if (!empty($foto)) {
            $allowed_extensions = array('png', 'jpg', 'jpeg', 'pdf');
            $dot = explode('.', $foto);
            $ekstensi = strtolower(end($dot));
            $file_tmp = $_FILES['foto']['tmp_name'];
            $new_foto = md5(uniqid($foto, true) . time()) . '.' . $ekstensi;

            if (in_array($ekstensi, $allowed_extensions)) {
                $upload_directory = 'filephoto/';
                if (!is_dir($upload_directory)) {
                    mkdir($upload_directory, 0755, true);
                }
                move_uploaded_file($file_tmp, $upload_directory . $new_foto);
                // Update the database with the new photo filename
                mysqli_query($conn, "UPDATE biodataasesi SET foto='$new_foto' WHERE id='$idu'");
            } else {
                echo 'File upload failed. Invalid file type.';
            }
        }

        // Redirect to the desired page
        header('location:asesi_apl01.php');
    } else {
        echo 'Update failed. Please try again.';
    }
}

if (isset($_POST['ubahasesor'])) {
    // Sanitize and retrieve form data
   
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $namasiswa = mysqli_real_escape_string($conn, $_POST['nama']);
    $ttl = mysqli_real_escape_string($conn, $_POST['ttl']);
    $jeniskelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $kodepos = mysqli_real_escape_string($conn, $_POST['kodepos']);
    $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tuk = mysqli_real_escape_string($conn, $_POST['tuk']);
    $nomet = mysqli_real_escape_string($conn, $_POST['nomet']);
    $foto = $_FILES['foto']['name'];
    $idu = mysqli_real_escape_string($conn, $_POST['id']);

    // Update data in the database
    $update = mysqli_query($conn, "UPDATE biodataasesor SET
        nik='$nik',
        nama='$namasiswa',
        ttl='$ttl',
        jenis_kelamin='$jeniskelamin',
        alamat='$alamat',
        nomet='$nomet',
        kodepos='$kodepos',
        nohp='$nohp',
        email='$email',
        tuk='$tuk'
        WHERE id='$idu'");

    if ($update) {
        // Upload new photo if provided
        if (!empty($foto)) {
            $allowed_extensions = array('png', 'jpg', 'jpeg', 'pdf');
            $dot = explode('.', $foto);
            $ekstensi = strtolower(end($dot));
            $file_tmp = $_FILES['foto']['tmp_name'];
            $new_foto = md5(uniqid($foto, true) . time()) . '.' . $ekstensi;

            if (in_array($ekstensi, $allowed_extensions)) {
                $upload_directory = 'filephoto/';
                if (!is_dir($upload_directory)) {
                    mkdir($upload_directory, 0755, true);
                }
                move_uploaded_file($file_tmp, $upload_directory . $new_foto);
                // Update the database with the new photo filename
                mysqli_query($conn, "UPDATE biodataasesor SET foto='$new_foto' WHERE id='$idu'");
            } else {
                echo 'File upload failed. Invalid file type.';
            }
        }

        // Redirect to the desired page
        header('location:asesor_tkj.php');
    } else {
        echo 'Update failed. Please try again.';
    }
}




// Ubah info Data Pengguna 
if (isset($_POST['updatepropilasesi'])) {
    $kodeasesor = $_POST['kode_asesi'];
    $nik = $_POST['nik'];
    $namasiswa = $_POST['nama'];
    $nis = $_POST['nis'];
    $jeniskelamin = $_POST['jenis_kelamin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ttl = $_POST['ttl'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $kodepos = $_POST['kodepos'];
    $lembaga = $_POST['lembaga'];
    $alamat_sekolah = $_POST['alamat_sekolah'];
    $kodepos_sekolah = $_POST['kodepos_sekolah'];
    $nohp_sekolah = $_POST['nohp_sekolah'];
    $email_sekolah = $_POST['email_sekolah'];

    $idu = $_POST['id'];

    // Validasi apakah data sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM biodataasesi WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung == 0) {
        // Jika data belum ada, lakukan insert
        $insert = mysqli_query($conn, "INSERT INTO biodataasesi ( username, password, id) VALUES ( '$username', '$password', '$idu')");
        
        if ($insert) {
            header('location:asesi_editpropil.php');
        } else {
            echo 'Gagal Bro!';
        }

    } else {
        // Jika data sudah ada, lakukan update
        $update = mysqli_query($conn, "UPDATE biodataasesi SET username='$username', password='$password' WHERE id='$idu'");
        
        if ($update) {
            header('location:asesi_editpropil.php');
        } else {
            echo 'Gagal Bro!';
        }
    }
}





// Ubah ingfo Data Pengguna Buat USERRRRRRRRZ 
if (isset($_POST['updateto'])) {
    $idu = $_POST['id'];
    $nis = $_POST['username'];
    $namasiswa = $_POST['first_name'];
    $fotonya = $_POST['photo'];
    $kelasnya = $_POST['kelas'];
    $passwordo = $_POST['password'];
    $levelnya = $_POST['user_type'];

    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ngambil ekstensti
    $ukuran = $_FILES['file']['size']; //ngambil size 
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi file

    //penamaan file ->> enkripsi nama file
    $foto = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dengn ekstensi

    //validasi alat sudah ada ato blm
    $cek = mysqli_query($conn, "SELECT * FROM tkj WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($ukuran == 0) {

        $update = mysqli_query($conn, "UPDATE tkj set username='$nis', first_name='$namasiswa',  kelas='$kelasnya', password='$passwordo' ,user_type='$levelnya' WHERE id='$idu'");
        if ($update) {
            header('location:menu_siswa.php');
        } else {
            echo 'Gagal BRuhhhh';

        }

    } else {
        // jika iya
        move_uploaded_file($file_tmp, 'poto/' . $foto);
        $update = mysqli_query($conn, "UPDATE tkj set username='$nis', first_name='$namasiswa', photo='$foto', kelas='$kelasnya', password='$passwordo' ,user_type='$levelnya' WHERE id='$idu'");
        if ($update) {
            header('location:menu_siswa.php');
        } else {
            echo 'Gagal BRuhhhh';

        }
    }

}

// Ubah ingfo Data Pengguna Buat USERRRRRRRRZ 
if (isset($_POST['up'])) {
        $kodeasesor = $data['kode_asesor'];
        $nik = $data['nik'];
        $namasiswa = $data['nama'];
        $nomet = $data['nomet'];
        $jeniskelamin = $data['jenis_kelamin'];
        $kode = $data['username'];
        $password = $data['password'];
        $ttl = $data['ttl'];
        $nohp = $data['nohp'];
        $email = $data['email'];
       $alamat = $data['alamat'];
        $kodepos = $data['kodepos'];
        $jabatan = $data['jabatan'];
        $lembaga = $data['lembaga'];
        $alamat_sekolah = $data['alamat_sekolah'];
        $kodepos_sekolah = $data['kodepos_sekolah'];
        $nohp_sekolah = $data['nohp_sekolah'];
        $email_sekolah = $data['email_sekolah'];
        $jurusan = $data['tuk'];
        $foto = $data['foto'];
        $idu = $data['id'];
                                             


    //validasi alat sudah ada ato blm
    $cek = mysqli_query($conn, "SELECT * FROM biodataasesor WHERE id='$idu'");
    $hitung = mysqli_num_rows($cek);

    if ($ukuran == 0) {

        $update = mysqli_query($conn, "UPDATE biodataasesor set kode_asesor='$kodeasesor', nik='$nik',  nama='$namasiswa', nomet='$nomet' ,jenis_kelamin='$jeniskelamin', nohp='$nohp', email='$email', alamat='$alamat', kodepos='$kodepos', jabatan='$jabatan' WHERE id='$idu'");
        if ($update) {
            header('location:asesor_propile.php');
        } else {
            echo 'Gagal BRuhhhh';

        }

    } else {
        // jika iya
        move_uploaded_file($file_tmp, 'poto/' . $foto);
        $update = mysqli_query($conn, "UPDATE biodataasesor set kode_asesor='$kodeasesor', nik='$nik',  nama='$namasiswa', nomet='$nomet' ,jenis_kelamin='$jeniskelamin', nohp='$nohp', email='$email', alamat='$alamat', kodepos='$kodepos', jabatan='$jabatan' WHERE id='$idu'");
        if ($update) {
            header('location:asesor_propile.php');
        } else {
            echo 'Gagal BRuhhhh';

        }
    }

}



//hapus data user rouu dari EKSISTENSI!!!
if (isset($_POST['hapusdatauser'])) {
    $idu = $_POST['id'];

    $gambar = mysqli_query($conn, "SELECT * FROM tkj WHERE id='$idu'");
    $get = mysqli_fetch_array($gambar);
    $img = 'poto/' . $get['photo'];
    unlink($img);

    $hapus = mysqli_query($conn, "DELETE from tkj WHERE id='$idu'");
    if ($hapus) {
        header('location:tabeluser.php');
    } else {
        echo 'Gagal BRuhhhh';
        header('location:tabeluser.php');
    }
}




//menambahkan alat dipinjam
if (isset($_POST['minjem'])) {
    $alattkj = $_POST['alattkj'];
    $qty_pinjam = $_POST['qty_pinjam'];
    $nama = $_POST['nama'];
    $kebutuhan = $_POST['kebutuhan'];


    $cekalatsekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$alattkj'");
    $datanya = mysqli_fetch_array($cekalatsekarang);

    $datasekarang = $datanya['jumlah'];

    if ($datasekarang >= $qty_pinjam) {
        $tambahjumlahalat = $datasekarang - $qty_pinjam;

        $addtopinjam = mysqli_query($conn, "INSERT INTO pinjam_bang (idalat, qty_pinjam, kebutuhan, nama) values('$alattkj', '$qty_pinjam', '$kebutuhan', '$nama')");
        $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$tambahjumlahalat' WHERE idalat ='$alattkj'");

        if ($addtopinjam && $updatealat) {
            header('location:pinjambeneran.php');
        } else {
            echo 'Gagal Menambahkan Data';

        }
    } else {
        // kalo alat ga cukup
        echo '
        <script>
            alert("Jumlah Alat saat ini tidak MENCUKUPI");
            window.location.href=pinjam_alat.php
        </script>';
    }
}


//balikin  alat 
if (isset($_POST['balikin'])) {
    $idpinj = $_POST['id_pinjam'];
    $idalatnya = $_POST['idalat'];


    $updatestatus = mysqli_query($conn, "UPDATE pinjam_bang SET status='Dikembalikan' WHERE id_pinjam='$idpinj'");

    $balikinalat1 = mysqli_query($conn, "SELECT * FROM stock  WHERE idalat='$idalatnya'");
    $jumlahpinjam1 = mysqli_fetch_array($balikinalat1);
    $dataalato = $jumlahpinjam1['jumlah'];


    $balikinalat2 = mysqli_query($conn, "SELECT * FROM pinjam_bang  WHERE id_pinjam='$idpinj'");
    $jumlahpinjam2 = mysqli_fetch_array($balikinalat2);
    $dataalato1 = $jumlahpinjam2['qty_pinjam'];

    $balikinbang = $dataalato1 + $dataalato;

    $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$balikinbang' WHERE idalat ='$idalatnya'");

    if ($updatestatus && $updatealat) {
        header('location:pinjambeneran.php');
    } else {
        echo 'Gagal Menambahkan Data';

    }


}



//menambahkan alat dipinjam siswa
if (isset($_POST['siswaminjem'])) {
    $idbang = $_POST['alattkj'];
    $qty_pinjam = $_POST['qty_pinjam'];
    $nama = $_POST['nama'];
    $alasanne = $_POST['alasan'];
    $kelasne = $_POST['kelas'];
    $kebutuhan = $_POST['kebutuhan'];
    $tanggalbalikin = $_POST['tanggalbalikin'];


    $cekalatsekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$idbang'");
    $datanya = mysqli_fetch_array($cekalatsekarang);

    $datasekarang = $datanya['jumlah'];

    if ($datasekarang >= 1) {
        $tambahjumlahalat = $datasekarang - $qty_pinjam;

        $addtopinjam = mysqli_query($conn, "INSERT INTO pinjam_bang (idalat, qty_pinjam, alasan, kebutuhan, nama, kelas,tanggalbalikin) values('$idbang', '$qty_pinjam', '$alasanne', '$kebutuhan', '$nama', '$kelasne','$tanggalbalikin')");
        $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$tambahjumlahalat' WHERE idalat ='$idbang'");

        if ($addtopinjam && $updatealat) {
            
            header('location:siswapinjemalat.php');
        } else {
            echo 'Gagal Menambahkan Data';

        }
    } else {
        // kalo alat ga cukup
        echo '
        <script>
            alert("Jumlah Alat saat ini tidak MENCUKUPI");
            window.location.href=siswapinjemalat.php
        </script>';
    }
}



//menambahkan alat dipinjam siswa
if (isset($_POST['dataminjem'])) {
    $idbang = $_POST['pinjem'];
    $qty_pinjam = $_POST['qty_pinjam'];
    $nama = $_POST['nama'];
    $kelasne = $_POST['kelas'];
    $kebutuhan = $_POST['kebutuhan'];
    $alasanne = $_POST['alasan'];
    $tanggalbalikin = $_POST['tanggalbalikin'];
    


    $cekalatsekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$idbang'");
    $datanya = mysqli_fetch_array($cekalatsekarang);

    $datasekarang = $datanya['jumlah'];

    if ($datasekarang >= $qty_pinjam) {
        $tambahjumlahalat = $datasekarang - $qty_pinjam;

        $addtopinjam = mysqli_query($conn, "INSERT INTO pinjam_bang (idalat, qty_pinjam, kebutuhan, nama, alasan,kelas, tanggalbalikin) values('$idbang', '$qty_pinjam', '$kebutuhan', '$nama', '$alasanne','$kelasne','$tanggalbalikin')");
        $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$tambahjumlahalat' WHERE idalat ='$idbang'");

        if ($addtopinjam && $updatealat) {
            ;
            header('location:riwayatpinjam.php');
        } else {
            echo 'Gagal Menambahkan Data';

        }
    } else {
        // kalo alat ga cukup
        echo '
        <script>
            alert("Jumlah Alat saat ini tidak MENCUKUPI");
            window.location.href=riwayatpinjam.php
        </script>';
    }
}


//balikin  alat 
if (isset($_POST['sudhbalik'])) {
    $idpinj = $_POST['id_pinjam'];
    $idalatnya = $_POST['idalat'];


    $updatestatus = mysqli_query($conn, "UPDATE pinjam_bang SET status ='Sudah Dikembalikan' WHERE id_pinjam='$idpinj'");

    $balikinalat1 = mysqli_query($conn, "SELECT * FROM stock  WHERE idalat='$idalatnya'");
    $jumlahpinjam1 = mysqli_fetch_array($balikinalat1);
    $dataalato = $jumlahpinjam1['jumlah'];


    $balikinalat2 = mysqli_query($conn, "SELECT * FROM pinjam_bang  WHERE id_pinjam='$idpinj'");
    $jumlahpinjam2 = mysqli_fetch_array($balikinalat2);
    $dataalato1 = $jumlahpinjam2['qty_pinjam'];

    $balikinbang = $dataalato1 + $dataalato;

    $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$balikinbang' WHERE idalat ='$idalatnya'");

    if ($updatestatus && $updatealat) {
        header('location:liatriwayat.php');
    } else {
        echo 'Gagal Menambahkan Data';

    }

}




//menambahkan alat dipinjam admin
if (isset($_POST['orangminjem'])) {
    $alattkj = $_POST['alattkj'];
    $qty_pinjam = $_POST['qty_pinjam'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $kebutuhan = $_POST['kebutuhan'];
    $tanggalbalikin = $_POST['tanggalbalikin'];


    $cekalatsekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idalat='$alattkj'");
    $datanya = mysqli_fetch_array($cekalatsekarang);

    $datasekarang = $datanya['jumlah'];

    if ($datasekarang >= $qty_pinjam) {
        $tambahjumlahalat = $datasekarang - $qty_pinjam;

        $addtopinjam = mysqli_query($conn, "INSERT INTO pinjam_bang (idalat, qty_pinjam, kebutuhan, nama, kelas,tanggalbalikin) values('$alattkj', '$qty_pinjam', '$kebutuhan', '$nama', '$kelas','$tanggalbalikin')");
        $updatealat = mysqli_query($conn, "UPDATE stock SET jumlah = '$tambahjumlahalat' WHERE idalat ='$alattkj'");

        if ($addtopinjam && $updatealat) {
            header('location:pinjemadmin.php');
        } else {
            echo 'Gagal Menambahkan Data';

        }
    } else {
        // kalo alat ga cukup
        echo '
        <script>
            alert("Jumlah Alat saat ini tidak MENCUKUPI");
            window.location.href=pinjemadmin.php
        </script>';
    }
}


// Ubah ingfo Data Pengguna 
if (isset($_POST['ubahsiswa'])) {
    $idu = $_POST['iduser'];
    $nis = $_POST['username'];
    $namasiswa = $_POST['fullname'];
    $fotonya = $_POST['foto'];
    $kelasnya = $_POST['kelas'];
    $passwordo = $_POST['password'];
    $levelnya = $_POST['level'];

    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //nama file gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //ngambil ekstensti
    $ukuran = $_FILES['file']['size']; //ngambil size 
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi file

    //penamaan file ->> enkripsi nama file
    $foto = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file yg dienkripsi dengn ekstensi

    //validasi alat sudah ada ato blm
    $cek = mysqli_query($conn, "SELECT * FROM login WHERE username='$username'");
    $hitung = mysqli_num_rows($cek);

    if ($ukuran == 0) {

        $update = mysqli_query($conn, "UPDATE login set username='$nis', fullname='$namasiswa', foto='$fotonya', kelas='$kelasnya', password='$passwordo' ,level='$levelnya' WHERE iduser='$idu'");
        if ($update) {
            header('location:tabeluser.php');
        } else {
            echo 'Gagal BRuhhhh';

        }

    } else {
        // jika iya
        move_uploaded_file($file_tmp, 'photo/' . $foto);
        $update = mysqli_query($conn, "UPDATE login set username='$nis', fullname='$namasiswa', foto='$fotonya', kelas='$kelasnya', password='$passwordo' ,level='$levelnya' WHERE iduser='$idu'");
        if ($update) {
            header('location:tabeluser.php');
        } else {
            echo 'Gagal BRuhhhh';

        }
    }

}




// Nambahin Igfo Bang
if (isset($_POST['ingfobang'])) {
    $namainfo = $_POST['namainfo'];
    $info = $_POST['informasi'];


    $addto = mysqli_query($conn, "INSERT into ingfo (namainfo, informasi ) VALUE ('$namainfo', '$info')");
    if ($addto) {
        header('location:liatinfo.php');
    } else {
        echo 'Gagal bng';
    }
}


// ubah Infomarsi
if (isset($_POST['gantiinfo'])) {
    $idif = $_POST['idinfo'];
    $isinya = $_POST['informasi'];

    $cek = mysqli_query($conn, "SELECT * FROM ingfo WHERE idinfo='$idif'");

    $update = mysqli_query($conn, "UPDATE ingfo set  informasi='$isinya' WHERE idinfo='$idif'");
    if ($update) {
        header('location:liatinfo.php');
    } else {
        echo 'Gagal BRuhhhh';

    }
}



//hapus info rouu dari EKSISTENSI!!!
if (isset($_POST['hapusinfo'])) {
    $idif = $_POST['idinfo'];

    $hapusinfo = mysqli_query($conn, "SELECT * FROM ingfo WHERE idinfo='$idif'");

    $hapus = mysqli_query($conn, "DELETE from ingfo WHERE idinfo='$idif'");
    if ($hapus) {
        header('location:liatinfo.php');
    } else {
        echo 'Gagal BRuhhhh';
    }
}


?>

