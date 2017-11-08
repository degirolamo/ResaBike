<html>
<div class="container">
<head>
    <link rel="stylesheet" type="text/css" href="/resabike/assets/css/perso.css">
    <!--Import Google Icon Font-->
    <link href="/resabike/assets/css/icon.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/resabike/assets/css/materialize.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>


<body class="body-login">
<div class="div-login">
        <h2 style="margin-bottom: 5%;"><?php trad('Login'); ?></h2>
        <form class="login-form col s6" method="POST">
            <div class="row smallRow">
                <div style="margin-left: 22%" class="input-field col s6" >
                    <i class="material-icons prefix">account_circle</i>
                    <label for="pseudo"><?php trad('Username'); ?></label>
                    <input name="pseudo" id="pseudo" type="text" class="validate" required="required">
                </div>

                <div class="row smallRow">
                        <div class="col s12">
                            <div  style="margin-left: 22%"  class="input-field col s6">
                                <i class="material-icons prefix">lock_outline</i>
                                <label for="mdp"><?php trad('password'); ?></label>
                                <input name="mdp" id="mdp" type="password" class="validate" required="required">
                            </div>
                        </div>
                </div>
            </div>
            <button class="btn waves-effect waves-light resa-btn" name="connect" type="submit"><?php trad('Connection'); ?></button>
            <a href="/resabike/index" class="btn waves-effect waves-light resa-btn"><?php trad('Cancel'); ?></a>
            <br/>
            <br/>
        </form>
</div>

<!--Import jQuery before materialize.js-->
<script src="/resabike/assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/resabike/assets/js/materialize.js"></script>
<script type="text/javascript" src="/resabike/assets/js/resabike.js"></script>

</body>
</div>
</html>