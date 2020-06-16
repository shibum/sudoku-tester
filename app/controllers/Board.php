<?php 

class Board extends Controller {
    private $board = array();

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    /**
     * the place where you feed sudoku data and validates the result.
     * param $_POST values are loaded from header POST
     * @return renders index page if not submitted, else validates and renders the result screen 
     */
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

            if(!$this->isFilled()) {
                Router::redirect('board/result/notfilled');
                return;
            }

            if(!$this->isValidRowColumn()) {
                Router::redirect('board/result/repeatedRowOrCol');
                return;
            }

            if(!$this->isValidBox()) {
                Router::redirect('board/result/boxrepeated');
                return;
            }

            Router::redirect('board/result/success');
        }
        $this->view->render('board/index');        
    }

    /**
     * renders the result
     * @param queryParams $queryParams result status
     * @return renders result page 
     */
    public function resultAction($queryParams) {
        $this->view->render('board/result', $queryParams);
    }

    
    /**
     * Check if all the values are filled in the sudoku matrix (board array)
     * @return true if all the values are filled in the board, else false 
     */
    private function isFilled(): bool {
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
     * Loop through the values by rows and columns to check if any values are repeated in a row or column
     * @return true if numbers are not repeated in rows and columns, else false
     */
    private function isValidRowColumn(): bool {
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
     * Checking if the number is repeated within of 3x3 sub matrix
     * Looping and incrementing by 3 with the initial coordinates given to check the next box.
     * @return true if sub matrix of 3x3 are valid and no repition, else false 
     */
    private function isValidBox(): bool {
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
