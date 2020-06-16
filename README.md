# sudoku-tester

The goal of this challenge is to implement a PHP function that checks whether the given sudoku is valid or not.

## Code architecture and tools

- Architecture - MVC architecture, created from scratch
- bootstrap - CSS framework
- HTML, Javascript

#### Note: 
- Not using Modals since it does not require database connection, 
- Not using JS validation because the whole challenge is on PHP

## Core Functions
Apart from the MVC framework, the core functions to validate the given multi-dimentional array is valid sudoku or not as follows:

```
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

function isFilled(): bool {
  # returns true if all the values are filled in the board, else false
}

function isValidRowColumn(): bool {
  # returns true if numbers are not repeated in rows and columns, else false
}

function isValidBox(): bool {
  # returns true if sub matrix of 3x3 are valid and no repition, else false
}
```

## How to get it work?

It's prettry simple. Fork the repository and run it with webserver that supports PHP7.  Make sure you have rewrite modules enabled in your httpd.conf or php.ini files.


## Demo

You have a working demo deployed at [Heroku][heroku] platform. You can find the link below:

[sudoku-tester](https://sudoku-tester.herokuapp.com/)

There are doors to improve in the frontend which I haven't concentrated much here.

Thank you!

### License

[MIT](LICENSE)
