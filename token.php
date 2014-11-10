<?php

class Token {
    public $type;
    public $text;
    
    public function Token($type, $text, $mode) {
        $this->type = $type;
        $this->text = $text;
        $file = $this->storage($mode);
        if ($mode == 2)
            print_r($file);
    }

    public function storage($mode) {
        static $file_lexer;
        static $i = 0;

        if ($mode == 1) {
            $more->type = $this->type;
            $more->text = $this->text;
            $file_lexer[$i] = $more;
            $i++;
        } else {
      //      print_r($file_lexer);
            return $file_lexer;
        }
    }

}
