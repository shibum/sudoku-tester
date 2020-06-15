<?php $this->start('body'); ?>
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <div class="text-center result-container">
            <?php
            switch ($this->queryParam()) {
                case 'success':
                    echo '<div class="alert alert-success" role="alert">
                            Wow! That\'s greate!  You got it right.
                        </div>';
                    break;
                case 'notfilled':
                    echo '<div class="alert alert-danger" role="alert">
                            Oh Oh... You have to fill in all the cells.
                        </div>';
                    break;
                case 'repeatedRowOrCol':
                    echo '<div class="alert alert-danger" role="alert">
                            Ouch! some of the rows or column values are repeated.
                        </div>';
                    break;
                case 'boxrepeated':
                    echo '<div class="alert alert-danger" role="alert">
                            Almost there! but some of the boxes are having repeated sequence.
                        </div>';
                    break;
                default:
                echo '<div class="alert alert-primary" role="alert">
                        Ummm.. did you land here by mistake??
                    </div>';
                break;
                
            }
            ?>
            <a class="btn btn-outline-secondary" href="<?=PROOT?>board/">Lets do it again!</a>
        </div>
    </div>
</div>
<?php $this->end(); ?>