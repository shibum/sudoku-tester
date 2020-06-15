<?php 

class Board extends Controller {
    private $board = array();

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function indexAction() {
        if($_POST) {
            $this->board = [
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0]
            ];
            
            foreach ($this->board as $row => $cols) {
                foreach ($cols as $col => $cellValue) {
                    $this->board[$row][$col] = Input::getInt('t'.($row+1).($col+1));
                }
            }

            if(!$this->checkFilledValue()) {
                Router::redirect('board/result/notfilled');
                return;
            }

            if(!$this->repeatedRowOrColumnValues()) {
                Router::redirect('board/result/repeatedRowOrCol');
                return;
            }

            if(!$this->checkBoxReptition()) {
                Router::redirect('board/result/boxrepeated');
                return;
            }

            Router::redirect('board/result/success');
        }
        $this->view->render('board/index');        
    }

    public function resultAction($queryParams) {
        $this->view->render('board/result', $queryParams);
    }

    /**
     * 
     * Check if all the values are filled in the sudoku matrix (board array)
     * if not filled return false.
     */
    private function checkFilledValue(): bool {
        foreach ($this->board as $row => $cols) {
            foreach ($cols as $col => $cellValue) {
                if($this->board[$row][$col] == 0 || $this->board[$row][$col] > 9 || $this->board[$row][$col] < 1) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 
     * Loop through the values by rows and columns
     * return true if nothing repeated in rows or columns otherwise return false.
     */
    private function repeatedRowOrColumnValues(): bool {
        foreach ($this->board as $row => $cols) {
            $curRow = [];
            $curCol = [];
            foreach ($cols as $col => $cellValue) {
                // check if repeated in row
                if(in_array($this->board[$row][$col], $curRow)){
                    return false;
                }
                array_push($curRow, $this->board[$row][$col]);

                // check if repeated in column 
                if(in_array($this->board[$col][$row], $curCol)){
                    return false;
                }
                array_push($curCol, $this->board[$col][$row]);
            }
        }
        return true;
    }

    /**
     * 
     * Checking if the number repeated within of 3x3 box.
     * Looping and incrementing by 3 with the initial coordinates given.
     */
    private function checkBoxReptition(): bool {
        $boxCoordinates = [
            [0,0], [0,1], [0,2],
            [1,0], [1,1], [1,2],
            [2,0], [2,1], [2,2]
        ];
        for($y=0; $y<9; $y+=3) {
            for($x=0; $x<9; $x+=3) {
                $curBox = [];
                for($i=0; $i<9; $i++) {
                    $coordinates = $boxCoordinates[$i];
                    $coordinates[0] += $y;
                    $coordinates[1] += $x;
                    if(in_array($this->board[$coordinates[0]][$coordinates[1]], $curBox)){
                        return false;
                    }
                    array_push($curBox, $this->board[$coordinates[0]][$coordinates[1]]);
                }
            }
        }
        return true;
    }

}
