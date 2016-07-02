<?php

class Admin
{
    /**
     *
     * @var string
     */
    private $host = "localhost";

    /**
     *
     * @var string
     */
    private $user = "cobrajdlr";

    /**
     *
     * @var string
     */
    private $pswd = "aarsa";

    /**
     *
     * @var string
     */
    private $db   = "cobrajdlr";

    /**
     *
     * @var mysqli
     */
    private $con;

    /**
     *
     * @var string
     */
    private $ticket;

    /**
     *
     * @var string
     */
    private $capt;

    public function __construct()
    {
        $this->con    = mysqli_connect($this->host, $this->user, $this->pswd,
            $this->db) or die("Could not connect to MySQL");
        $this->ticket = $this->con->real_escape_string(filter_input(INPUT_COOKIE,
                'auth'));
        $this->capt   = $this->con->real_escape_string(filter_input(INPUT_GET,
                'capt'));
        if (empty($this->capt)) {
            $this->capt = $this->con->real_escape_string(filter_input(INPUT_POST,
                    'capt'));
        }
        if (empty($this->capt)) {
            header('index.php');
        }
        $this->adminCheck();
        return $this;
    }

    private function adminCheck()
    {
        $count      = 0;
        $querycheck = "SELECT count(1) FROM nombres WHERE ticket=? "
            ."AND iniciales=? AND tipo='admin';";
        $stc        = $this->con->stmt_init();
        $stc->prepare($querycheck);
        $stc->bind_param('ss', $this->ticket, $this->capt);
        $stc->execute();
        $stc->bind_result($count);
        while ($stc->fetch()) {
            if ($count != 1) {
                $redirector = 'Location: index.php';
                header($redirector);
            }
        }
    }

    /**
     *
     * @return string
     */
    public function getCapt()
    {
        return $this->capt;
    }

    /**
     *
     * @return mysqli
     */
    public function getCon()
    {
        return $this->con;
    }
}