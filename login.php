<?php
include 'database/db.php';
session_start();
if(isset($_POST['submit'])){
    $name =$_POST['name'];
    $password = $_POST['password'];
    
    $userselected= $conn->prepare("SELECT * FROM users WHERE name=? AND pass=? ");
    $userselected->bindValue(1,$name);
    $userselected->bindValue(2,$password);
    $userselected->execute();

    $users=$userselected->fetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user);
    if($userselected->rowCount()>=1){

        $_SESSION['name']=$name;
        $_SESSION['email']=$user['email'];
        $_SESSION['name']=$name;
        $_SESSION['login']='true';
        $_SESSION['roll'] =$user['roll']; 
        var_dump($user['roll']);
        header('location:index.php');
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>log in </title>
</head>

<body dir="rtl">
    <?php include 'header.php'; ?>

  <div class="container">
<div class="center" style="text-align:center;">
    <h2 style="text-align:center;"> ورود</h2>
    <br><br><br><br>
    <form  method="post">
         <input type="text" name="name" placeholder=" نام کاربری" class="form-control">
         
    <br><br><br>
         
         <input type="password" name="password" placeholder=" پسورد " class="form-control">
         
    <br><br>
         <input type="submit" name="submit" value="ورود " class="form-control btn btn-info" >
    </form>
</div>

  </div>



  <footer>


    <div class="footerParent" style="margin-top:30vh ;">
      <div class="MediaNav">
        <ul>
          <li><a>اینستاگرام</a></li>
          <li><a>واتساپ</a></li>
        </ul>
      </div>
      <div class="MoreContact">
        <ul>
          <li><span> آدرس: <br>
              <p>ایران ، تهران ، سعادت آیاد ...</p>
            </span></li>
          <li><span>شماره تماس : <br>
              <p>09372982748</p>
            </span></li>
          <li><span>ایمیل :<br>
              <p>Msoheilamini@gmail.com</p>
            </span></li>
        </ul>
      </div>
      <div class="footerAbout">
        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. </p>
      </div>

    </div>
  </footer>



</body>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>