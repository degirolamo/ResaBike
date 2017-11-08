<div class="container">
    <h1><?php trad('All Books'); ?></h1></td>
    <table class="bordered">
        <thead>
        <tr>

            <th><?php trad('Date'); ?></th>
            <th><?php trad('Email'); ?></th>
            <th><?php trad('Number of bikes'); ?></th>
            <th><?php trad('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php
        var_dump($books);
        $html = "";
        foreach($books as $book) {
            $actions = '
            
            
            <!-- Modal Trigger -->
            <a href="#modal'.$book['id'].'" class="waves-effect waves-light btn modal-trigger resa-btn">
                <i class="large material-icons">delete</i>
            </a> 
    
            <!-- Modal Structure -->
            <div id="modal'.$book['id'].'" class="modal">
                <div class="modal-content">
                    <h4>'. trad('Suppression of the book of', true) .' '.$book['dateDepart'].'</h4>
                    <p>'. trad('Are you sure that you want to delete this book ? ', true) .'</p>
                </div>
                <div class="modal-footer">
                    <a href="/resabike/book/delete?id='.$book['id'].'" class="waves-effect waves-light btn modal-trigger resa-btn">'. trad('Confirme', true) .'</a>
                    <a href="" class="waves-effect waves-light btn modal-trigger resa-btn">'. trad('Cancel', true) .'</a>
                </div>
            </div>';



            $html .= '<tr>
                <td>'.strftime('%e %b %Y %H:%m', strtotime($book['dateDepart'])).'</td>
                <td>'.$book['email'].'</td>
                <td>'.$book['nbVelos'].'</td>
                <td>'.$actions.'</td>
            </tr>';

        }

        echo $html;
        ?>
        </tbody>
    </table>
</div>
