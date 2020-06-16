<?php $this->start('head'); ?>
<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function updateTable(evt) {
        for (i = 1; i <= 9; i++) {
            document.getElementById('t' + evt.target.id + i).value = '';
        }

        let val = evt.target.value;
        let cellValues = val.split("");
        for (i = 0; i < cellValues.length; i++) {
            document.getElementById('t' + evt.target.id + (i + 1)).value = cellValues[i];
        }


    }
</script>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="p-3 p-md-5 m-md-3 text-center bg-light" id="bootstrap-overrides">
    <p class="lead font-weight-normal">Enter the values from 1-9 in the cells or the rows. Click on the cells to enter the value. Or enter the values in the text boxes labelled as Row.</p>
    <br>
    <form class="form" name="form" action="<?=PROOT?>board/index" method="POST">
        <div class="d-inline-block">
            <?php
                for($i=1; $i<10; $i++) {
                    echo '<div class="row">';
                    echo '<div class="col"><div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Row ' . $i . ' </span>
                            </div>
                            <input type="text" id="'.$i.'" name="'.$i.'" class="form-control row-input" placeholder="1-9" aria-label="row" aria-describedby="basic-addon1" maxlength="9" onkeyup="return updateTable(event)" onkeypress="return isNumberKey(event)">
                        </div></div></div>';
                }
                ?>
        </div>
        <div class="d-inline-block align-top grid-holder">
            <table id="puzzle_grid" cellspacing="0" cellpadding="0" class="table table-bordered">
                <colgroup>
                    <col>
                    <col>
                    <col class="col-border">
                    <col>
                    <col>
                    <col class="col-border">
                    <col>
                    <col>
                    <col>
                </colgroup>
                <tbody>
                    <?php
                        for($i=1; $i<10; $i++) {
                            echo ($i%3 === 0 && $i != 9 ? '<tr class="row-border">' : '<tr>');
                            for($j=1; $j<10; $j++) {
                                echo '<td class="col-border" id="c'. $i . $j .'"><input maxlength="1" class="no-border" autocomplete="off" name="t'. $i . $j .'" value="" id="t'. $i . $j .'"></td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <input type="submit" value="Validate my answer" class="btn btn-large btn-primary">
        </div>
    </form>
</div>
<?php $this->end(); ?>