

<html>
<head>
    <link rel="stylesheet" type="text/css" href="/resabike/assets/css/login.css">
    <!--Import Google Icon Font-->
    <link href="../../../assets/css/icon.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/resabike/assets/css/materialize.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<table class="bordered">
<tr>
<?php
 $_SESSION['date'];
?>
</tr>
<tr>
    <th><?php trad('Hour'); ?></th>
    <th><?php trad('From'); ?></th>
    <th><?php trad('To'); ?></th>
</tr>
<tr>
   <td>10h10</td>
    <td> <?php
       echo $_SESSION['from'];
        ?>
    </td>
    <td> <?php
       echo $_SESSION['to'];
        ?>
    </td>
    <td>
        <form class="login-form col s12" method="POST">
        <button class="waves-effect waves-light btn" name="reserv" type="submit"><?php trad('Booking'); ?></button>
        </form>
    </td>
</tr>
</table>
</body>
</html>