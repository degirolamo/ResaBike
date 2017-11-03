<html>
<head>
    <!--Import Google Icon Font-->
    <link href="/resabike/assets/css/icon.css" rel="stylesheet">
    <link href="/resabike/assets/css/perso.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/resabike/assets/css/materialize.css" media="screen,projection"/>
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

                    <ul class="right" style="display:inline-block; margin-right: -15%;">
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

                        <li><a href="/resabike/index/about"><?php trad('About', true); ?></a></li>
                        <li><a href="/resabike/index/about"><?php trad('About'); ?></a></li>
                        <li><a href="/resabike/index/contact"><?php trad('Contact Us'); ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</header>

<main>
    <?php echo $html; ?>
</main>

<footer></footer>
</body>
</html>