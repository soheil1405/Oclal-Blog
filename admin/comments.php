<?php

include '../database/db.php';


$select=$conn->prepare("SELECT * FROM comment");
$select->execute();
$users_comment=$select->fetchAll(PDO::FETCH_ASSOC);
$number=1;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mainarticle.css">
    <link rel="stylesheet" href="../css/adminstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>مشاهده نویسندگان</title>
</head>
<body>


<?php
include 'navbar.php';

?>
    <h4 style="text-align:center;">مشاهده نظرات </h4>

    <div class="container">
        <div class="table">
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ردیف</th>
      <th scope="col">نام کاربری</th>
      <th scope="col"> مقاله </th>
      <th scope="col"> کامنت</th>
      <th scope="col"> عملیات</th>
    </tr>
  </thead>

    <?php
    foreach($users_comment as $user):
        $post_id = $user['post_id'];
        $post_select = $conn->prepare("SELECT * FROM ocaladb WHERE id=?" );
        $post_select->bindValue(1,$post_id);
        $post_select->execute();
        $allposts=$post_select->fetchAll(PDO::FETCH_ASSOC);
        foreach($allposts as $p);
        ?>
    <tbody>   
    <tr>
      <th scope="row"><?= $number++ ?></th>
      <td><?= $user['user_name'] ?></td>
      <td><?= $p['title']; ?></td>
      <td><?= $user['comment'] ?></td>       
      <td><a href="commentController.php?id=<?= $user['id']; ?>&what=delete" class="btn btn-danger">حذف</a></td>
    </tr>
    </tbody>   
    <?php endforeach;  ?>

</table>
        </div>
    </div>


    <footer>


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