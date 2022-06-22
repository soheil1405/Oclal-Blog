<?php
session_start();
include 'header.php';
include 'database/db.php';


if(isset($_POST['search-bt'])){

      $q=$_POST['search-title'];
      header('Location:search.php?q='.$q);
  
}

$select = $conn->prepare("SELECT * FROM ocaladb");
$select->execute();
$blog = $select->fetchAll(PDO::FETCH_ASSOC);

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
  <link rel="stylesheet" href="css/loader.css">
  <title>ocala blog</title>
</head>

  <div class="container">



    <div class="search">
      <div class="serchinsid">

        <form action="" method="post" class="myform">
          <div class="col-12 col-lg-10">

            <input type="text" name="search-title" id="searchinput" placeholder="دنبال چی میگردی؟" class="form form-control input">

            <input style="height: 40px ;" type="submit" id="submit" name="search-bt" class="btn btn-info sub" value="جستجو">
          </div>
        </form>
      </div>
    </div>

    <h3 id="newArticeTitle">آخرین مقالات منتشر شده </h3>

    <div class="itemsbox" style="display:flex; flex-wrap:wrap ;">
      <?php foreach ($blog as $blogs) :

      //number of comments
        $comment = $conn->prepare("SELECT COUNT(*) FROM comment WHERE post_id=?");
        $comment->bindValue(1,$blogs['id']);
        $comment->execute();
        $c_num=$comment->fetchColumn();

        // number of views

        $view_num = $conn->prepare("SELECT COUNT(*) FROM views WHERE post_id=?");
        $view_num->bindValue(1,$blogs['id']);
        $view_num->execute();
        $v_num=$view_num->fetchColumn();
        
        
        
        ?>

        <div class="col-12 col-lg-4 newarticles" style="height:400px ;">
          <div class="boxes" style="height:400px ;">
            <img src="<?= $blogs['image']  ?>" alt="<?= $blogs['title']  ?>" class="boxes-img">
            <p class="boxtitle"><?= $blogs['title']  ?> </p>
            <span class="boxdetail"><?= mb_strimwidth($blogs['caption'], 0, 20, "...");  ?></span>
            <a href="blog/blog.php?id=<?= $blogs['id']; ?>&writer=<?= $blogs['writer'] ?>">بیشتر ...</a>
            <div class="co-view">

              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
              </svg>
              <span id="boxspbottum"><?= $v_num ?></span>
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
              </svg><span id="boxspbottum"><?= $c_num ?></span>

            </div>
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg><span id="boxspbottum">سهیل امینی</span>
            </div>
          </div>
        </div>

      <?php endforeach;  ?>
      </div>

    <h3 id="newArticeTitle">پر بازدید ترین مقالات </h3>

    <div class="row">

      <div class="col-12 col-lg-6">
        <div class="head-image">
          <img src="img/kotlet.jpg" alt="کتلت" id="centerImg">
        </div>
      </div>

      <div class="col-12 col-lg-3">
        <div class="head-image">
          <img src="img/pizza1.jpg" alt="پیتزا" id="centerImg">
        </div>
      </div>

      <div class="col-12 col-lg-3">
        <div class="head-image">
          <img src="img/ash.jpg" alt="آش" id="centerImg">
        </div>
      </div>
    </div>




    <div class="text-box" style="margin: 50px 0px !important ;">
      <span>اُکالا به منظور تسهیل امر خرید برای شهروندان، صرفه جویی در زمان و در نهایت کاهش حمل و نقل های درون شهری، با ارائه کالاهایی با کیفیت بالا و همچنین قیمتی کاملا مناسب و رقابتی در سال 1396 شروع به فعالیت نمود.</span>
      <a href="#">بیشتر...</a>
    </div>
</div>



  <footer >


    <div class="footerParent">
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