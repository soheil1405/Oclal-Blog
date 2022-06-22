<?php
include '../library/jdf.php';
include '../database/db.php';

$writerselected=$conn->prepare("SELECT * FROM writer");
$writerselected->execute();
$writerList=$writerselected->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){


$date = jdate('y:m:d');
$title=$_POST['title'];
$caption=$_POST['addcaption'];
$timetoread=$_POST['timetoread'];
$photopath=$_POST['photopath'];
$writer=$_POST['writer'];
$tags=$_POST['tags'];
$title=$_POST['title'];
$insert = $conn->prepare("INSERT INTO ocaladb SET title=? , caption=? , writer=? ,  date =? , readtime=? , image=? , tags=?");
$insert->bindvalue(1,$title);
$insert->bindvalue(2,$caption);
$insert->bindvalue(3,$writer);
$insert->bindvalue(4,$date);
$insert->bindvalue(5,$timetoread);
$insert->bindvalue(6,$photopath);
$insert->bindvalue(7,$tags);
$insert->execute();
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
    <link rel="stylesheet" href="../css/adminstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>افزودن مقاله جدید</title>
</head>
<body>


<?php
include 'navbar.php';

?>
    <h4 style="text-align:center;">افزودن مقاله جدید</h4>

    <div class="container">
        <form action="" method="POST" class="myform">
            <input type="text" name="title" id="title" placeholder="موضوع مقاله" class="form-control">
            
            <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
            <col-12 class="col-lg-12">
                
            <textarea name="addcaption" id="addcaption">&lt;p&gt;متن اصلی مقاله&lt;/p&gt;</textarea>
            </col-12>
            <script>
                CKEDITOR.replace( 'addcaption' );
            </script>
            <select name="writer" class="form-control">
                <?php foreach($writerList as $writer):
                ?>
                <label for="selectwriter"> نویسنده :</label>
                <option id="selectwriter" value="<?= $writer['username']; ?>"><?= $writer['username']; ?> </option>
                <?php endforeach ;?>
            </select>
            
            <input type="number" name="timetoread" id="timetoread" placeholder="زمان تقریبی مطالعه مقاله " class="form-control">
            <input type="text" name="photopath" id="photopath" placeholder="لینک عکس" class="form-control">
            <input type="text" name="tags" id="tags" placeholder="تگ ها" class="form-control">
            <input type="submit" name="submit" value="ثبت مقاله" class="btn btn-success">

        </form>
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