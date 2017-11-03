<div class="container">
<div class="index-page">
    <div class="form">

        <h2 style="margin-bottom: 1%; margin-top: -0.5%">Type your research</h2>

        <form class="login-form col s6" method="POST">
            <div class="row smallRow">
                <div class="input-field col s6">
                    <label for="pseudo"><?php trad('Username'); ?></label>
                    <input id="pseudo" type="text" class="validate">
                </div>

                <div class="row smallRow">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <label for="nbrvelo"><?php trad('Number of bikes'); ?></label>
                            <input id="nbrvelo" type="number" min="0" max="10" class="validate">
                        </div>
                    </div>
                </div>
                <div class="row smallRow">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <input type="text" id="ifrom" name="from" class="validate autocomplete autocompleteDB">
                            <label for="ifrom"><?php trad('From'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="row smallRow">
                    <div class="col s12">
                        <div class="input-field col s6">
                            <input type="text" id="ito" name="to" class="validate autocomplete autocompleteDB">
                            <label for="ito"><?php trad('To'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="row smallRow">
                    <div class="input-field col s6">
                        <input id="iddate" type="text" class="datepicker" name="date">
                        <label for="datepicker"><?php trad('Date'); ?></label>
                    </div>
                </div>
                <div class="row smallRow">
                    <div class="input-field col s6">
                        <input type="text" class="timepicker">
                        <label for="timepicker"><?php trad('Hour'); ?></label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" name="submit"
                        type="submit"><?php trad('Search'); ?></button>
            </div>
        </form>
    </div>
</div>
</div>