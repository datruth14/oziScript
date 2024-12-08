<?php
/** Installation Guide (How To Use navbar)
 * After Downloading this widget, 
 * move it into your project file in (assets/widgets/navbar.php)
 * require it in between  the /*=== WIDGETS ==============/* Comment inside your project file in system_config.php 
 * save and call the widget navBarStyle() and navBar(), inside any of your componets root files and add the required parameters as follows::
 * Sample ::: <?php navBarStyle($bgColor = "#0082e6", $textColor = "white", $opacity = "0.9");?>
 * And at the bottom of navBarStyle(), call  navBar($logo = "DesignX", $navContents = ['Home' => '?s=home', 'About' => '?s=about', 'Services' => '?s=services', 'FAQ' => '?s=faq']) and update the required parameter. use the same method for all the navBarStyle() and navBar() types. As indicated by the numbers attaced below.
 * leave empty to see default values or update parameters as it suites you
 * thank you for chosing ozi...
 */




//Creating navBarStyle() :::::::::::::
//Creating navBarStyle() :::::::::::::
//Creating navBarStyle() :::::::::::::
//Creating navBarStyle() :::::::::::::
function navBarStyle($bgColor = "#0082e6", $textColor = "white", $opacity = "0.9")
{
?>
    <style>
        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            font-family: montserrat;
        }

        nav {
            background: <?php echo $bgColor; ?>;
            height: 80px;
            width: 100%;
        }

        label.logo {
            color: <?php echo $textColor; ?>;
            font-size: 35px;
            line-height: 80px;
            padding: 0 100px;
            font-weight: bold;
        }

        nav ul {
            float: right;
            margin-right: 20px;
        }

        nav ul li {
            display: inline-block;
            line-height: 80px;
            margin: 0 5px;
        }

        nav ul li a {
            color: <?php echo  $textColor; ?>;
            font-size: 17px;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
            text-decoration: none;
        }

        .checkbtn {
            font-size: 30px;
            color: white;
            float: right;
            line-height: 80px;
            margin-right: 40px;
            cursor: pointer;
            display: none;
        }

        #check {
            display: none;
        }

        @media (max-width: 952px) {
            label.logo {
                font-size: 30px;
                padding-left: 50px;
            }

            nav ul li a {
                font-size: 16px;
            }
        }

        @media (max-width: 858px) {
            .checkbtn {
                display: block;
            }

            ul {
                position: fixed;
                width: 100%;
                height: 100vh;
                background: <?php echo $bgColor; ?>;
                opacity: <?php echo $opacity; ?>;
                top: 80px;
                left: -100%;
                text-align: center;
                transition: all .5s;
            }

            nav ul li {
                display: block;
                margin: 50px 0;
                line-height: 30px;
            }

            nav ul li a {
                font-size: 20px;
            }

            a:hover,
            a.active {
                background: none;
                color: <?php echo $textColor; ?>;
                text-decoration: none;
            }

            #check:checked~ul {
                left: 0;
            }

        }
    </style>
<?php
}



//Creating navBar() :::::::::::::
//Creating navBar() :::::::::::::
//Creating navBar() :::::::::::::
//Creating navBar() :::::::::::::
function navBar($logo = "DesignX", $navContents = ['Home' => '?s=home', 'About' => '?s=about', 'Services' => '?s=services', 'FAQ' => '?s=faq'])
{
?>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"> <?php echo $logo; ?> </label>
        <ul>
            <?php
            $listContents =  $navContents;

            foreach ($listContents as $x => $x_value) {
                echo "<li><a href='" . $x_value . "'>" . $x . "</a></li>";
            }
            ?>
        </ul>
    </nav>
<?php
}





//Creating navBarStyle2 :::::::::::::
//Creating navBarStyle2 :::::::::::::
//Creating navBarStyle2 :::::::::::::
//Creating navBarStyle2 :::::::::::::

function navBarStyle2($bgColor = "#4a98f7", $textColor = "white", $sideBarBg = "#11101d")
{
?>
    <style>
        /* Google Fonts - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        .nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 200px;
            background: <?php echo $bgColor; ?>;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .nav,
        .nav .nav-links {
            display: flex;
            align-items: center;
        }

        .nav {
            justify-content: space-between;
        }

        .nav a {
            color: <?php echo $textColor; ?>;
            text-decoration: none;
        }

        .nav .logo {
            font-size: 22px;
            font-weight: 500;
        }

        .nav .nav-links {
            column-gap: 20px;
            list-style: none;
        }

        .nav .nav-links a {
            transition: all 0.2s linear;
        }

        .nav.openSearch .nav-links a {
            opacity: 0;
            pointer-events: none;
        }

        .nav .search-icon {
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }

        .nav .search-box {
            position: absolute;
            right: 250px;
            height: 45px;
            max-width: 555px;
            width: 100%;
            opacity: 0;
            pointer-events: none;
            transition: all 0.2s linear;
        }

        .nav.openSearch .search-box {
            opacity: 1;
            pointer-events: auto;
        }

        .search-box .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            left: 15px;
            color: #4a98f7;
            transform: translateY(-50%);
        }

        .search-box input {
            height: 100%;
            width: 100%;
            border: none;
            outline: none;
            border-radius: 6px;
            background-color: #fff;
            padding: 0 15px 0 45px;
        }

        .nav .navOpenBtn,
        .nav .navCloseBtn {
            display: none;
        }

        /* responsive */
        @media screen and (max-width: 1160px) {
            .nav {
                padding: 15px 100px;
            }

            .nav .search-box {
                right: 150px;
            }
        }

        @media screen and (max-width: 950px) {
            .nav {
                padding: 15px 50px;
            }

            .nav .search-box {
                right: 100px;
                max-width: 400px;
            }
        }

        @media screen and (max-width: 768px) {

            .nav .navOpenBtn,
            .nav .navCloseBtn {
                display: block;
            }

            .nav {
                padding: 15px 20px;
            }

            .nav .nav-links {
                position: fixed;
                top: 0;
                left: -100%;
                height: 100%;
                max-width: 280px;
                width: 100%;
                padding-top: 100px;
                row-gap: 30px;
                flex-direction: column;
                background-color: <?php echo $sideBarBg; ?>;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                transition: all 0.4s ease;
                z-index: 100;
            }

            .nav.openNav .nav-links {
                left: 0;
            }

            .nav .navOpenBtn {
                color: #fff;
                font-size: 20px;
                cursor: pointer;
            }

            .nav .navCloseBtn {
                position: absolute;
                top: 20px;
                right: 20px;
                color: #fff;
                font-size: 20px;
                cursor: pointer;
            }

            .nav .search-box {
                top: calc(100% + 10px);
                max-width: calc(100% - 20px);
                right: 50%;
                transform: translateX(50%);
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
<?php
}
//Creating navBar2 :::::::::::::
//Creating navBar2 :::::::::::::
//Creating navBar2 :::::::::::::
//Creating navBar2 :::::::::::::
function navBar2($logo = "DesignX", $navContents = ['Home' => '?s=home', 'About' => '?s=about', 'Services' => '?s=services', 'FAQ' => '?s=faq'])
{
?>
    <nav class="nav">
        <i class="uil uil-bars navOpenBtn"></i>
        <a href="#" class="logo"> <?php echo $logo; ?></a>
        <ul class="nav-links">
            <i class="uil uil-times navCloseBtn"></i>
            <?php
            $listContents =  $navContents;

            foreach ($listContents as $x => $x_value) {
                echo "<li><a href='" . $x_value . "'>" . $x . "</a></li>";
            }
            ?>
        </ul>

        <i class="uil uil-search search-icon" id="searchIcon"></i>
        <div class="search-box">
            <form action="" method="POST">
                <i class="uil uil-search search-icon"></i>
                <input type="text" name="data" placeholder="Search here..." style="padding-top:12px" />
            </form>
        </div>
    </nav>

    <script>
        const nav = document.querySelector(".nav"),
            searchIcon = document.querySelector("#searchIcon"),
            navOpenBtn = document.querySelector(".navOpenBtn"),
            navCloseBtn = document.querySelector(".navCloseBtn");

        searchIcon.addEventListener("click", () => {
            nav.classList.toggle("openSearch");
            nav.classList.remove("openNav");
            if (nav.classList.contains("openSearch")) {
                return searchIcon.classList.replace("uil-search", "uil-times");
            }
            searchIcon.classList.replace("uil-times", "uil-search");
        });

        navOpenBtn.addEventListener("click", () => {
            nav.classList.add("openNav");
            nav.classList.remove("openSearch");
            searchIcon.classList.replace("uil-times", "uil-search");
        });
        navCloseBtn.addEventListener("click", () => {
            nav.classList.remove("openNav");
        });
    </script>
<?php
}



//Creating navBarStyle3 :::::::::::::
function navBarStyle3($bgColorOne = "#c850c0", $bgColorTwo = "#4158d0", $textColor = "white")
{
?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(-135deg, <?php echo $bgColorOne; ?>, <?php echo $bgColorTwo; ?>);
            /* background: linear-gradient(375deg, #1cc7d0, #2ede98); */
            /* clip-path: circle(25px at calc(0% + 45px) 45px); */
            clip-path: circle(25px at calc(100% - 45px) 45px);
            transition: all 0.3s ease-in-out;
        }

        #active:checked~.wrapper {
            clip-path: circle(75%);
        }

        .menu-btn {
            position: absolute;
            z-index: 2;
            right: 20px;
            /* left: 20px; */
            top: 20px;
            height: 50px;
            width: 50px;
            text-align: center;
            line-height: 50px;
            border-radius: 50%;
            font-size: 20px;
            color: <?php echo $textColor; ?>;
            cursor: pointer;
            background: linear-gradient(-135deg, <?php echo $bgColorOne; ?>, <?php echo $bgColorTwo; ?>);
            /* background: linear-gradient(375deg, #1cc7d0, #2ede98); */
            transition: all 0.3s ease-in-out;
        }

        #active:checked~.menu-btn {
            background: <?php echo $textColor; ?>;
            color: <?php echo $bgColorTwo; ?>;
        }

        #active:checked~.menu-btn i:before {
            content: "\f00d";
        }

        .wrapper ul {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            list-style: none;
            text-align: center;
        }

        .wrapper ul li {
            margin: 15px 0;
        }

        .wrapper ul li a {
            color: none;
            text-decoration: none;
            font-size: 30px;
            font-weight: 500;
            padding: 5px 30px;
            color: #fff;
            position: relative;
            line-height: 50px;
            transition: all 0.3s ease;
        }

        .wrapper ul li a:after {
            position: absolute;
            content: "";
            background: #fff;
            width: 100%;
            height: 50px;
            left: 0;
            border-radius: 50px;
            transform: scaleY(0);
            z-index: -1;
            transition: transform 0.3s ease;
        }

        .wrapper ul li a:hover:after {
            transform: scaleY(1);
        }

        .wrapper ul li a:hover {
            color: <?php echo $bgColorTwo; ?>;
        }

        input[type="checkbox"] {
            display: none;
        }
    </style>
<?php
}

//Creating navBar3 :::::::::::::
//Creating navBar3 :::::::::::::
//Creating navBar3 :::::::::::::
//Creating navBar3 :::::::::::::
function navBar3($navContents = ['Home' => '?s=home', 'About' => '?s=about', 'Services' => '?s=services', 'FAQ' => '?s=faq'])
{
?>
    
    <div class="fixed-top">
    <input type="checkbox" id="active">
    <label for="active" class="menu-btn"><i class="fas fa-bars"></i></label>
    <div class="wrapper">
        <ul>
            <?php
            $listContents =  $navContents;

            foreach ($listContents as $x => $x_value) {
                echo "<li><a href='" . $x_value . "'>" . $x . "</a></li>";
            }
            ?>
        </ul>
    </div>
    </div>



    <script>
    </script>
<?php
}
