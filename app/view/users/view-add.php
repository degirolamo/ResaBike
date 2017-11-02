<div class="container">
    <div class="row">
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="pseudo" name="pseudo" type="text" class="validate" required>
                    <label for="last_name"><?php trad('Username'); ?></label>
                </div>
            </div>
            <div class="row">


                <div class="input-field col s12">
                    <select name="idRole" id="select-role">

                        <?php
                        foreach($roles as $role) {

                            echo '<option value="'.$role['id'].'">'.$role['nom'].'</option>';
                         }
                        ?>

                   </select>
                    <label><?php trad('Roles'); ?></label>
                </div>


            </div>

            <div class="row" id="div-zone">
                <div class="input-field col s12">
                    <select name="idZone">

                        <?php
                        foreach($zones as $zone) {
                        echo '<option value="'.$zone['id'].'">'.$zone['nom'].'</option>';
                        }
                        ?>

                    </select>
                    <label><?php trad('Zone'); ?></label>
                </div>




            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate" required>
                    <label for="email"><?php trad('Email'); ?></label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" name="submit" type="submit"><?php trad('Confirme'); ?></button>
            <a href="/resabike/users" class="btn waves-effect waves-light"><?php trad('Cancel'); ?></a>

        </form>
    </div>
</div>