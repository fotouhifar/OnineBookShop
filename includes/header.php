<!DOCTYPE html>

<?PHP
extract($_POST);
if (!isset($search))
    $search = '';

//echo $_SESSION['OBSusertype'];
//echo $_SESSION['OBSid'];
?>
<html>
    <head>
        <title>Online Book Shop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="<?= CSS_URL ?>main.css" rel="stylesheet" type="text/css" >
        <script> var PROJECT_URL = "<?= PROJECT_URL ?>";</script>
        <script src="<?= JS_URL ?>jquery-1.11.0.min.js" type="text/javascript" ></script>
        <script src="<?= JS_URL ?>js.js" type="text/javascript" ></script>
    </head>

    <body>
        <nav>
            <ul>
                <li id="menuHome"><a href="<?= PROJECT_URL ?>"><div style="background-image: url('<?= MENUIMAGE ?>HomeLogo.jpg');"></div></a></li>
                <li class="menuItem" id="menuProducts"><a href="<?= PROJECT_URL ?>products/all"><div>Product List</div></a></li>
                <li class="menuItem" id="menuBlog"><a href="<?= PROJECT_URL ?>blog"><div>Blog</div></a></li>
                <li class="menuItem" id="menuAbout"><a href="<?= PROJECT_URL ?>about"><div>About</div></a></li>
                <li class="menuItem" id="menuContact"><a href="<?= PROJECT_URL ?>contact"><div>Contact</div></a></li>
                <li class="menuItem" id="menuCart"><a href="<?= PROJECT_URL ?>cart"><div>Cart<P><?PHP
                                if ($this->controller->isCart()) {
                                    echo "(" . $this->controller->getCartItemCount() . ")";
                                }
                                ?></p></div></a></li>

                <li>
                    <ul>
                        <li id="menuItemBreadcrumb">
                            <?PHP
                            $pageTitle = array();
                            $url = array();


                            $url = explode('/', $_SERVER["REQUEST_URI"]);
                            foreach ($url as $key => $value) {
                                echo ($value) ? $key . '=>' . $value : '';
                            }
                            echo count($url) . '<br>';

                            //             $_SESSION['OBSbread'][0] = $_SERVER["REQUEST_URI"];
                            //             foreach ($_SESSION['OBSbread'] as $key=> $value)
                            //             echo $key.'=>'.$value;
                            ?>
                            <!--
                            
                            <a href="">Home</a>
                            <span class="separator"> > </span>
                            <a href="">Products</a>
                            <span class="separator"> > </span>
                            <a href="">Books</a>
                            <span class="separator"> > </span>
                            <a href="">Novel</a>

                            -->
                        </li>
                        <br>


                        <li id="menuItemSearch"><div>Search<form 
                                    action="<?= PROJECT_URL ?>search" 
                                    target="_blank" method="post">
                                    <input id="search" type="search" name="search"
                                           style="background-image: url('<?= MENUIMAGE ?>searchicon.png');"
                                           value="<?PHP
                                           if (isset($search)) {
                                               echo $search;
                                           }
                                           ?>"></form></div></li>

                        <?php
                        if ($this->controller->isSignedIn() && $_SESSION['OBSusertype'] == 'customer') {
                            ?>   
                            <li id="menuItemAccount"><a href="<?= PROJECT_URL ?>account"><div>Account
                                        <p>
                                            Hi
                                            <?PHP
                                            $name = ucfirst($_SESSION['OBSname']);
                                            echo " $name";
                                            ?>

                                        </p></div> </a></li>
                            <li id="menuItemLogout"><a href="<?= PROJECT_URL ?>signout"><div>Log out</div></a>
                                <?php
                            } elseif ($this->controller->isSignedIn() && $_SESSION['OBSusertype'] == 'admin') {
                                ?>   

                            <li id="menuItemAccount"><a href="<?= PROJECT_URL ?>dashboard"><div>Dashboard
                                        <p>
                                            Hi Admin
                                            <?PHP
                                            $name = ucfirst($_SESSION['OBSname']);
                                            echo " $name";
                                            ?>

                                        </p></div> </a></li>
                            <li id="menuItemLogout"><a href="<?= PROJECT_URL ?>signout"><div>Log out</div></a>
                                <?php
                            } else {
                                ?>
                            <li id="menuItemLogin"><div>
                                    <form id="LoginForm" action="<?= PROJECT_URL ?>signin" method="post" onsubmit="return validateLoginForm();">
                                        <input id="loginEmail" type="email" name="em" value="amir@far.com" required>
                                        <input id="loginPassword" type="password" name="pw" value="123" required>
                                        <input id="loginSubmitButton" type="submit" value="In">
                                    </form>
                                </div> </li>
                            <li id="menuItemRegister">
                                <a href="<?= PROJECT_URL ?>register"><div>Register</div></a></li>

                            <li id="socialMediaLogin">

                                <ul>
                                    <li id="facebookLogin"><a href="facebook.com">
                                            <div style="background-image: url('<?= MENUIMAGE ?>facebook.jpg');"></div></a></li>
                                    <li id="twitterLogin"><a href="twitter.com">
                                            <div style="background-image: url('<?= MENUIMAGE ?>twitter.jpg');"></div></a></li>
                                </ul>

                                <?php
                            }
                            ?>
                        </li>

                    </ul>
            </ul>

        </nav>
        <?PHP
        //     echo "URL = " . $_SERVER["REQUEST_URI"] . "<br>";
        $pageTitle = array();
        $url = array();

        $url = explode('/', $_SERVER["REQUEST_URI"]);

        /*
          foreach ($url as $key => $value) {
          echo ($value) ? $key . '=>' . $value : '';
          echo '<br>';
          }
          echo count($url) . '<br>';
         */



        //                 $_SESSION['OBSbread'][0] = $_SERVER["REQUEST_URI"];
        //                 foreach ($_SESSION['OBSbread'] as $key=> $value)
        //              echo $key.'=>'.$value;
        ?>

