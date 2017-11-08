<div class="container">
    <div class="row">
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="nom" name="nom" type="text" class="validate" required>
                    <label for="nom"><?php trad('Zone\'s name'); ?></label>
                </div>
            </div>
            <button class="btn waves-effect waves-light resa-btn" name="submit" type="submit"><?php trad('Confirme'); ?></button>
            <a href="/resabike/zone" class="btn waves-effect waves-light resa-btn"><?php trad('Cancel'); ?></a>

        </form>
    </div>
</div>