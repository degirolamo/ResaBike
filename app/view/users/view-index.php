<div class="container">
    <h1><?php trad('All users'); ?></h1></td>
    <a class="btn waves-effect waves-light resa-btn" href="/resabike/users/add"><?php trad('Add a new user'); ?></a>
    <table class="bordered">
        <thead>
        <tr>
            <th><?php trad('Username'); ?></th>
            <th><?php trad('Role'); ?></th>
            <th><?php trad('Zone'); ?></th>
            <th><?php trad('Email'); ?></th>
            <th><?php trad('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $html = "";
        foreach ($users as $user) {


            if ($user['idRole'] != 3) {

                $actions = '
            <a href="/resabike/users/edit?id=' . $user['id'] . '" class="waves-effect waves-light btn resa-btn">
                <i class="large material-icons">edit</i>
            </a>
            <!-- Modal Trigger -->
            <a href="#modal' . $user['id'] . '" class="waves-effect waves-light btn modal-trigger resa-btn">
                <i class="large material-icons">delete</i>
            </a> 

            <!-- Modal Structure -->
            <div id="modal' . $user['id'] . '" class="modal">
                <div class="modal-content">
                    <h4>' . trad('Suppression of the user', true) . '' . $user['pseudo'] . '</h4>
                    <p>' . trad('Are you sure that you want to delete this user ? ', true) . '</p>
                </div>
                <div class="modal-footer">
                    <a href="/resabike/users/delete?id=' . $user['id'] . '" class="waves-effect waves-light btn modal-trigger resa-btn">' . trad('Confirme', true) . '</a>
                    <a href="" class="waves-effect waves-light btn modal-trigger resa-btn">' . trad('Cancel', true) . '</a>
                </div>
            </div>';

                $html .= '<tr>
                <td>' . $user['pseudo'] . '</td>
                <td>' . $user['roleName'] . '</td>
                <td>' . $user['zoneName'] . '</td>
                <td>' . $user['email'] . '</td>
                <td>' . $actions . '</td>
            </tr>';
            }
        }

        echo $html;
        ?>
        </tbody>
    </table>
</div>
