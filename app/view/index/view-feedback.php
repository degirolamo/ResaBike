<div class="container">
    <div class="index-page">
        <div class="form">

            <h2 style="margin-bottom: 1%; margin-top: -0.5%"><?php trad('Send us a feedback') ?></h2>

            <form class="login-form col s6" method="POST">
                <div class="row smallRow">
                    <div class="input-field col s6">
                        <label for="pseudo"><?php trad('Username'); ?></label>
                        <input id="idPseudo" required type="text" class="validate" name="pseudo">
                    </div>
                </div>
                <div class="row smallRow">
                    <div class="input-field col s6">
                        <label for="mail"><?php trad('Email'); ?></label>
                        <input id="idMail" name="mail" required type="email" class="validate">
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea name="text" id="textarea1" class="materialize-textarea"></textarea>
                            <label for="textarea1"><?php trad('Text area'); ?></label>
                        </div>
                    </div>
                </div>

                <p>
                    <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" name="checkbox" value="of" />
                    <label for="filled-in-box"><?php trad('Receive a copy'); ?></label>
                </p>

                <button class="btn waves-effect waves-light resa-btn" id="btn-sendFeedback" name="sendFeedback" type="submit" >
                    <?php trad('Send'); ?>

                </button>

            </form>
        </div>
    </div>
</div>