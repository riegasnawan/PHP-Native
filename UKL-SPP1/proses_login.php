<?php 
session_start(); 
$conn = mysqli_connect('localhost','root','','bayar_spp'); 
$username = stripslashes($_POST['username']); 
$password = md5($_POST['password']); 
$query = "SELECT * FROM petugas where username='$username' AND password='$password'"; 
$row = mysqli_query($conn,$query); 
$data = mysqli_fetch_array($row);  
$cek = mysqli_num_rows($row);
$query1 = "SELECT * FROM siswa where username='$username' AND password='$password'"; 
$row1 = mysqli_query($conn,$query1); 
$data1 = mysqli_fetch_array($row1);  
$cek1 = mysqli_num_rows($row1);

if($cek > 0){
    
    if($data['level']== 'admin'){ 
        $_SESSION['level']='admin'; 
        $_SESSION['username'] = $data['username']; 
        $_SESSION['id_petugas'] = $data['id_petugas']; 
        $_SESSION['nama_petugas']=$data['nama_petugas'];
        $_SESSION['status_login']=true;
        header('location: admin/home.php'); 
    }else if($data['level'] =='petugas'){
        $_SESSION['level']='petugas';
        $_SESSION['username'] = $data['username'];
        $_SESSION['id_petugas']= $data['id_petugas']; 
        $_SESSION['nama_petugas']=$data['nama_petugas'];
        $_SESSION['status_login']=true;
        header('location: petugas/home.php'); 
    }
    
    }elseif($cek1 > 0){  
            $_SESSION['username'] = $data1['username'];
            $_SESSION ['nisn'] = $data1['nisn'] ;
            $_SESSION['nama_siswa']=$data1['nama_siswa'];
            $_SESSION['status_login']=true;
            header('location: siswa/home.php');
         
    }else{
        
        $msg = 'username Atau password Salah';
        echo '<script>alert("'.$msg.'");location.href="index.php"</script>';
         }
?>