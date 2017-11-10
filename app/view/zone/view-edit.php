<div class="container">
    <div class="row">
        <h5>Modification de zone :</h5>
    </div>
    <div class="row">
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="nom" name="nom" type="text" class="validate" value="<?php echo $zoneEdited['nom']; ?>">

                    <label for="nom"><?php trad('Zone\'s name'); ?></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="input-startStation" type="text" class="validate autocomplete autocompleteApi">

                    <label for="input-startStation"><?php trad('Start station'); ?></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="input-endStation" type="text" class="validate autocomplete autocompleteApi">

                    <label for="input-endStation"><?php trad('Final station'); ?></label>
                </div>
            </div>

            <button type="button" id="btn-search"
                    class="waves-effect waves-green btn resa-btn"><?php trad('Search'); ?></button>
            <button type="button" id="btn-add-all"
                    class="waves-effect waves-green btn resa-btn"><?php trad('Add all stations'); ?></button>
            <button type="submit" name="submitEdit"
                    class="waves-effect waves-green btn resa-btn"><?php trad('Terminate'); ?></button>

            <div class="row" id="div-add-stations">
                <table id="table-add-station">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-add-stations">

                    </tbody>
                </table>
            </div>

        </form>
    </div>
</div>