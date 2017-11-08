<html>
<head>
    <!--Import Google Icon Font-->
    <link href="/resabike/assets/css/icon.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/resabike/assets/css/materialize.css" media="screen,projection"/>

    <link href="/resabike/assets/css/perso.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Import jQuery before materialize.js-->
    <script src="/resabike/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/resabike/assets/js/materialize.js"></script>
    <script type="text/javascript" src="/resabike/assets/js/resabike.js"></script>
</head>

<body>
<header>
    <div class="navbar-fixed">
        <nav class="teal lighten-2">
            <div class="nav-wrapper">
                <div class="container">
                    <a style="margin-right: 15%;" class="brand-logo right"
                       href="/resabike/login/logout"><?php trad('Logout'); ?></a>

                    <ul class="right " style="display:inline-block; margin-right: -15%;">
                        <li>
                            <a href="<?php echo '/resabike/languages?lang=en&lastPage=' . $this->currentController . '/' . $this->currentAction; ?>">en</a>
                        </li>
                        <li>
                            <a href="<?php echo '/resabike/languages?lang=fr&lastPage=' . $this->currentController . '/' . $this->currentAction; ?>">fr</a>
                        </li>
                        <li>
                            <a href="<?php echo '/resabike/languages?lang=de&lastPage=' . $this->currentController . '/' . $this->currentAction; ?>">de</a>
                        </li>
                    </ul>
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li><i class="material-icons blackIcon"">directions_bike</i></li>
                        <!-- SysAdmin -->
                        <?php if ($_SESSION['UserConnected']['idRole'] >= 3) {
                            echo '<li><a href="/resabike/users">' .trad('Users', true) . '</a></li>';
                        } ?>
                        <!-- Admin -->
                        <?php if ($_SESSION['UserConnected']['idRole'] >= 2) {

                            echo '<li><a href="/resabike/zone">' .trad('Zones', true). '</a></li>';
                        } ?>
                        <!-- Driver -->
                        <?php if ($_SESSION['UserConnected']['idRole'] >= 1) {

                            echo '<li><a href="/resabike/book">' . trad('Books', true). '</a></li>';
                        } ?>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</header>

<main>
    <?php echo $html; ?>
</main>

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5><?php trad('How to contact us ?')?></h5>
                <p class="text-lighten-4"><?php trad('We invite you to send us a feedback about your experience on our website !')?></p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5><?php trad('Links')?></h5>
                <ul>
                    <li><i class="material-icons blackIcon"">contact_mail</i><a class="blackLinks" href="mailto:bestproject69kevdan@gmail.com"><?php trad('Contact us by email')?></a></li>
                    <li><i class="material-icons blackIcon"">web</i><a class="blackLinks" href="http://www.resabike.ch/">Resabike.ch</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 Copyright Daniel De Girolamo and Kevin Carneiro
        </div>
    </div>
</footer>
</body>
</html>