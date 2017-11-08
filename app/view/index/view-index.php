<div class="container">
    <div class="index-page">
        <div class="form">

            <h2 style="margin-bottom: 1%; margin-top: -0.5%"><?php trad('Type your research')?></h2>

            <form class="login-form col s6" method="POST">
                <div class="row smallRow">
                    <div class="input-field col s6">
                        <label for="pseudo"><?php trad('Email'); ?></label>
                        <input id="idMail" required type="email" class="validate">
                    </div>

                    <div class="row smallRow">
                        <div class="col s12">
                            <div class="input-field col s6">
                                <label for="nbrvelo"><?php trad('Number of bikes'); ?></label>
                                <input id="nbrvelo" required type="number" min="0" max="10" class="validate">
                            </div>
                        </div>
                    </div>
                    <div class="row smallRow">
                        <div class="col s12">
                            <div class="input-field col s6">
                                <input type="text" required id="idfrom" name="from"
                                       class="validate autocomplete autocompleteDB">
                                <label for="ifrom"><?php trad('From'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row smallRow">
                        <div class="col s12">
                            <div class="input-field col s6">
                                <input type="text" required id="idto" name="to"
                                       class="validate autocomplete autocompleteDB">
                                <label for="ito"><?php trad('To'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row smallRow">
                        <div class="col s12">
                            <div class="input-field col s6">
                                <input id="iddate" required type="text" class="datepicker" name="date">
                                <label for="datepicker"><?php trad('Date'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row smallRow">
                        <div class="col s12">
                            <div class="input-field col s6">
                                <input type="text" required class="timepicker" id="idtime" name="time">
                                <label for="timepicker"><?php trad('Hour'); ?></label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Trigger -->
                    <a id="btn-searchTime" class="waves-effect waves-light btn tooltipped modal-trigger resa-btn"
                       data-tooltip="search" href="#modalBook">
                        <i class="large material-icons">search</i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Structure -->
    <div id="modalBook" class="modal">
        <div class="modal-content">
            <h4><?php trad("List of availables buses")?></h4>
            <table class="resa-table striped">
                <thead>
                <tr>
                    <th><?php trad('From'); ?></th>
                    <th><?php trad('To'); ?></th>
                    <th><?php trad("Start time")?></th>
                    <th><?php trad('Arrived time')?></th>
                </tr>
                </thead>
                <tbody id="tabHeur">
                </tbody>
            </table>
        </div>
    </div>
    <div id="hiddenForm"></div>
</div>
</form>
</div>
</div>
</div>