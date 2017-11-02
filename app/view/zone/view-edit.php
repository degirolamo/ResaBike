

<div class="container">
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s12">

                    <input id="nom" type="text" class="validate" value="<?php echo $zoneEdited['nom']; ?>">

                    <label for="nom"><?php trad('Zone\'s name'); ?></label>
                </div>
            </div>

            <?php
            echo '<a href="/resabike/zone/update?id='.$zoneEdited['id'].'&nom='.$zoneEdited['nom'].'" class="modal-action modal-close waves-effect waves-green btn-flat">'. trad('Confirme', true) .'</a>';
            ?>
            <a href="/resabike/zone" class="btn waves-effect waves-light"><?php trad('Cancel'); ?></a>

        </form>
    </div>
</div>