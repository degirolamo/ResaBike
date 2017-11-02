<div class="container">
    <h1><?php trad('All Zones'); ?></h1></td>
    <a class="btn waves-effect waves-light" href="/resabike/zone/add"><?php trad('Add a zone'); ?></a>
    <table class="bordered">
        <thead>
        <tr>
            <th><?php trad('Id'); ?></th>
            <th><?php trad('Name'); ?></th>
            <th><?php trad('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $html = "";
        foreach($zones as $zone) {
            $actions = '
            <a href="/resabike/zone/edit?id='.$zone['id'].'" class="waves-effect waves-light btn">
                <i class="large material-icons">edit</i>
            </a>
            <!-- Modal Trigger -->
            <a href="#modal'.$zone['id'].'" class="waves-effect waves-light btn modal-trigger">
                <i class="large material-icons">delete</i>
            </a> 

            <!-- Modal Structure -->
            <div id="modal'.$zone['id'].'" class="modal">
                <div class="modal-content">
                    <h4>'. trad('Suppression of the zone', true) .''.$zone['nom'].'</h4>
                    <p>'. trad('Are you sure that you want to delete this zone ? ', true) .'</p>
                </div>
                <div class="modal-footer">
                    <a href="/resabike/zone/delete?id='.$zone['id'].'" class="modal-action modal-close waves-effect waves-green btn-flat">'. trad('Confirme', true) .'</a>
                    <a href="" class="modal-action modal-close waves-effect waves-green btn-flat">'. trad('Cancel', true) .'</a>
                </div>
            </div>';

            $html .= '<tr>
                <td>'.$zone['id'].'</td>
                <td>'.$zone['nom'].'</td>
                <td>'.$actions.'</td>
            </tr>';

        }

        echo $html;
        ?>
        </tbody>
    </table>
</div>