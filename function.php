<?php
session_start();
//membuat koneksi database
$conn = mysqli_connect("localhost", "root", "", "lsp");







//proses LOGIN

//proses LOGIN
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    
    $role = $_POST['role']; // Add this line to get the selected role

    // Choose the appropriate table based on the selected role
    switch ($role) {
        case 'nilaitkj':
        case 'dpib':
        case 'tkr':
        case 'tbsm':
        case 'tp':
        case 'tlas':
        case 'tmi':
        case 'elin':
            $table = $role;
            break;
        default:
            echo 'Invalid Role';
            header("location: index.php");
            exit();
    }

    $cekdatabase = mysqli_query($conn, "SELECT * FROM $table WHERE username='$username' ");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $data = mysqli_fetch_assoc($cekdatabase);

        // Check if hasil1 is not equal to "K"
        if ($data['hasil1'] !== 'K') {
            echo 'Maaf, Anda belum lolos asesmen.';
            header("location: index.php?pesan=gagal");
            exit();
        }

        $_SESSION['user_id'] = $data['id'];

        // Redirect to the appropriate dashboard
        switch ($role) {
            case 'nilaitkj':
                header("location: skilltkj.php");
                break;
            case 'dpib':
                header("location: skilldpib.php");
                break;
            case 'tkr':
                header("location: tkr.php");
                break;
            case 'tbsm':
                header("location: tbsm.php");
                break;
            case 'tp':
                header("location: skilltp.php");
                break;
            case 'tlas':
                header("location: skilltlas.php");
                break;
            case 'tmi':
                header("location: skilltmi.php");
                break;
            case 'elin':
                header("location: skillelin.php");
                break;
            default:
                echo 'Invalid Role';
                header("location: index.php");
                break;
        }
    } else {
        echo 'Username / Password Salah';
        header("location: index.php?pesan=gigil");
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




// ... Your existing code ...

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_data'])) {
    // Assuming you have a database connection already ($conn)

    // Sanitize and validate the data before using it in the query to prevent SQL injection
    $idu = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : '';

    // Handle file upload
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
    $updateStatusQuery = "UPDATE biodataasesi SET statusnilai = 'ternilai' WHERE nama='$tanggal_terpilih'";
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


if (isset($_POST['ubahassesiadmin'])) {
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
        if (!empty($_FILES['foto']['name'])) {
            $allowed_extensions = array('png', 'jpg', 'jpeg', 'pdf');
            $foto = $_FILES['foto']['name'];
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
        header('location:admin_asesiapl.php');
    } else {
        echo 'Update failed. Please try again.';
    }
}

if (isset($_POST['cekcekadmin'])) {
    $kk = isset($_POST['kk']) ? 1 : 0; // Set to 1 if checkbox is checked, 0 otherwise
    $rapor = isset($_POST['rapor']) ? 1 : 0;
    $sertifikat_pkl = isset($_POST['sertifikat_pkl']) ? 1 : 0;
    
    $idu = mysqli_real_escape_string($conn, $_POST['id']);
    
    // Update data in the database
    $update = mysqli_query($conn, "UPDATE biodataasesi SET
        kk='$kk',
        rapor='$rapor',
        sertifikat_pkl='$sertifikat_pkl'
        WHERE id='$idu'");
    
    if ($update) {
        // Success
        header('location:admin_asesiapl.php');
    } else {
        // Error
        echo 'Gagal Bro!';
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


?>

