

<div class="container">
    <div class="row">
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s12">

                    <input id="pseudo" type="text" class="validate" name="pseudo" value="<?php echo $userEdited['pseudo']; ?>">

                    <label for="last_name"><?php trad('Username'); ?></label>
                </div>
            </div>
            <div class="row">


                <div class="input-field col s12">
                    <select name="idRole" id="idRole">

                        <?php
                        foreach($roles as $role) {

                            if ($role['id'] == $userEdited['idRole']) {

                                echo '<option selected="selected" value="'.$role['id'].'">'.$role['nom'].'</option>';
                            }
                            else{

                                echo '<option value="' . $role['id'] . '">' . $role['nom'] . '</option>';
                            }

                        }
                        ?>

                    </select>
                    <label><?php trad('Roles'); ?></label>
                </div>


            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="idZone" id="idZone">

                        <?php
                        foreach($zones as $zone) {

                            if ($zone['id'] == $userEdited['idZone']) {

                                echo '<option selected="selected" value="'.$zone['id'].'">'.$zone['nom'].'</option>';
                            }
                            else{

                                echo '<option value="' . $zone['id'] . '">' . $zone['nom'] . '</option>';
                            }

                        }
                        ?>

                    </select>
                    <label><?php trad('Zones'); ?></label>
                </div>




            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input name="email" id="email" type="email" class="validate" value="<?php echo $userEdited['email']; ?>">
                    <label for="email"><?php trad('Email'); ?></label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" name="submit" type="submit"><?php trad('Confirme'); ?></button>
            <a href="/resabike/users" class="btn waves-effect waves-light"><?php trad('Cancel'); ?></a>

        </form>
    </div>
</div>