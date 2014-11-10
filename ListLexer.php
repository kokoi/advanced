    <?php

require_once('lexer.php');

class ListLexer extends Lexer {
    const NAME      = 2;
    const SHARP     = 3;
    static $tokenNames = array("n/a", "<EOF>",
                               "NAME", "SHARP" );
    
    public function getTokenName($x) {
        return ListLexer::$tokenNames[$x];
    }

    public function ListLexer($input) {
        parent::__construct($input);
    }

    public function getFileParsing() {
       $token = new Token(null, null, 2);
        //print_r ($token);
        //pourquoi cet enculé me stock rien ?
    }

    public function isLETTER() {
       return $this->c >= 'a' &&
        $this->c <= 'z' ||
        $this->c >= 'A' &&
        $this->c <= 'Z';
    }


    public function nextToken() {
        while ( $this->c != self::EOF ) {
            switch ( $this->c ) {
                case ' ' :  case '\t': case '\n': case '\r': $this->WS();
                           continue;
                case '#' : /*$this->consume();*/
                            $this->COMMENT();
                           //return new Token(self::SHARP, "#",1);
                default:
                    if ($this->isLETTER() ) return $this->NAME();
                    throw new Exception("invalid character: " . $this->c);
            }
        }
        return new Token(self::EOF_TYPE,"<EOF>",1);
    }

    /** NAME : ('a'..'z'|'A'..'Z')+; // NAME is sequence of >=1 letter */
    public function NAME() {
        $buf = '';
        do {
            $buf .= $this->c;
            $this->consume();
        } while ($this->isLETTER());
        
        return new Token(self::NAME, $buf,1);
    }


    public function COMMENT() {
        $comment = "";
        while ($this->c != '\n' && $this->c != self::EOF){
            $comment .= $this->c;
            $this->consume();
        }
        die($comment);
    }

    /** WS : (' '|'\t'|'\n'|'\r')* ; // ignore any whitespace */
    public function WS() {
        while(ctype_space($this->c)) {
            $this->consume();
        }
    }
}
