<?php
session_start();
include '../database/db.php';

//select post detail from database
$id = $_GET['id'];
$select = $conn->prepare("SELECT * FROM ocaladb WHERE id=?");
$select->bindValue(1, $id);
$select->execute();
$selected_post = $select->fetchAll(PDO::FETCH_ASSOC);
foreach ($selected_post as $t);
$final_tags = explode('،', $t['tags']);

//select writers detail from database
$writer = $_GET['writer'];
$post_writer = $conn->prepare("SELECT * FROM writer WHERE username=?");
$post_writer->bindValue(1, $writer);
$post_writer->execute();


//improve the view of post to 1 more
$improve_post_view = $conn->prepare("INSERT INTO views SET post_id=?");
$improve_post_view->bindValue(1, $id);
$improve_post_view->execute();

//get the final number of views
$f_view = 0;
$v = $conn->prepare("SELECT * FROM views WHERE post_id=?");
$v->bindValue(1, $id);
$v->execute();
$final_v = $v->fetchAll(PDO::FETCH_ASSOC);
foreach ($final_v as $view) {
    $f_view++;
}
//add new comment to database
if (isset($_POST['submit'])) {
    $username = $_SESSION['name'];
    $comment = $_POST['editor1'];
    $insert = $conn->prepare("INSERT INTO comment SET post_id=? , user_name=? , comment=?");
    $insert->bindValue(1, $id);
    $insert->bindValue(2, $username);
    $insert->bindValue(3, $comment);
    $insert->execute();
}
//get all comments from database
$c = $conn->prepare("SELECT * FROM comment WHERE post_id=?");
$c->bindValue(1, $id);
$c->execute();
$selected_comments = $c->fetchAll(PDO::FETCH_ASSOC);
$number_of_comments = 0;
foreach ($selected_comments as $n) {
    $number_of_comments++;
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="../img/logo.png" alt="لوگو سایت اکالا" style="height:50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">خانه <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">

                <li class="nav-item">
                    <a class="nav-link" href="#" id="nav-link-rank">اخبار روز</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" id="nav-link-rank">درباره ما</a>
                </li>


            </ul>
        </div>
    </nav>



    <div class="container">

        <div class="col-12 col-lg-9">
            <?php
            foreach ($selected_post as $blogs) :
            ?>

                <div class="mainarticle">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg><span id="boxspbottum"><?= $blogs['writer'] ?> </span>
                    </div>
                    <div class="co-view">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg><span id="boxspbottum"><?= $f_view ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                        </svg><span id="boxspbottum"><?= $number_of_comments ?></span>
                        <div class="time" style="display: INLINE; flex-direction:row;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                            <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z" />
                        </svg><span>  خواندن این مقاله  <p style="display: INLINE;"><?= $blogs['readtime'] ?></p>دقیقه زمان میبرد...</span>

                        </div>
                    </div>
                    <img src="<?= $blogs['image'] ?>" alt="<?= $blogs['title'] ?>" class="mainarticleimg">
                    <p class="boxtitle"><?= $blogs['title'] ?></p>
                    <span class="boxdetail"><?= $blogs['caption'] ?></span>
                </div>

            <?php
            endforeach;
            ?>
            <?php foreach ($post_writer as $thiswriter) : ?>

                <div class="about-writer">
                    <a href="">
                        <div style="display:flex ;margin:40px 20px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            <span>نویسنده : <?= $thiswriter['username']; ?> </span>
                        </div>
                    </a>
                    <div class="about-writer-inslide">
                        <div class="col-12 col-lg-4">
                            <img src="<?= $thiswriter['profileImage']; ?>" alt="">
                        </div>
                        <div class="col-12 col-lg-7 about-writer-inslide-info-text ">
                            <p><?= $thiswriter['bio']; ?></p>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>
            <div class="tags">
                <p id="tagtitle">برچسب ها</p>
                <?php foreach ($final_tags as $s) : ?>

                    <a href=""><span><?= $s; ?></span></a>
                <?php endforeach; ?>

            </div>

            <div class="comment">
                <p style="margin: 30px 0px ;">دیدگاهتان را بنویسید :</p>
                <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
                <form action="" method="post">

                    <textarea name="editor1" id="editor1">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>
                    <script>
                        CKEDITOR.replace('editor1');
                    </script>
                    <input type="submit" value="ثبت دیدگاه" name="submit" class="btn btn-success btsendcomment">
                </form>
            </div>
            <p>دیدگاه های شما :
            </p>
            <?php
            foreach ($selected_comments as $s) :
            ?>
                <div class="user-comment">
                    <p class="user-comment-username"><?= $s['user_name'] ?></p>
                    <span class="user-comment-comment"><?= $s['comment'] ?></span>
                </div>

            <?php
            endforeach;
            ?>



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