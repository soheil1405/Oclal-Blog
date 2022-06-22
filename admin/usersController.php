<?php
include '../database/db.php';
$what = $_GET['what'];
$id = $_GET['id'];
if ($what == 'delete') {
    $delete = $conn->prepare("DELETE FROM users WHERE id=?");
    $delete->bindValue(1, $id);
    $delete->execute();
    header('Location:users.php');
} elseif ($what == 'edit') {
    $user = $conn->prepare("SELECT* FROM users WHERE id=?");
    $user->bindValue(1, $id);
    $user->execute();
    $selectedUser = $user->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $email = &$_POST['email'];
        $pass = $_POST['pass'];
        if($_POST['userAcess']=='manualUser'){
            $access=1;
        }else{
            $access=2;
        }
        $update = $conn->prepare("UPDATE users SET name=? , email=? , pass=? , roll=? WHERE id=?");
        $update->bindValue(1, $name);
        $update->bindValue(2, $email);
        $update->bindValue(3, $pass);
        $update->bindValue(4, $id);
        $update->bindValue(5, $access);
        $update->execute();
        session_reset();
        header('Location:users.php');
    }
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
    <title>ویرایش نویسنده</title>
</head>

<body>


    <?php
    include 'navbar.php';

    ?>
    <div class="container">
        <?php if ($what == 'edit') { ?>

            <?php foreach ($selectedUser as $thisselecteduser) : ?>

                <h4 style="text-align:center;">ویرایش کاربران</h4>

                <form action="" method="POST" class="myform" style="display: flex; flex-direction:column;">

                    <input type="text" name="name" id="title" placeholder="نام کاربری " class="form-control" value="<?= $thisselecteduser['name']; ?>">
                    <input type="text" name="pass" id="email" placeholder=" لینک عکس پروفایل " class="form-control" value="<?= $thisselecteduser['pass']; ?>">
                    <input type="email" name="email" id="email" placeholder=" لینک عکس پروفایل " class="form-control" value="<?= $thisselecteduser['email']; ?>">

                    <div class="access">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userAcess" id="manualUser" value="manualUser" checked>
                            <label class="form-check-label" for="manualUser" style="margin-right: 30px;">
                                کاربر عادی
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userAcess" id="adminUser" value="adminUser">
                            <label class="form-check-label" for="adminUser" style="margin-right: 30px;">
                                ادمین
                            </label>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="ویرایش" class="btn btn-success">
                </form>
            <?php endforeach; ?>
        <?php } ?>
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