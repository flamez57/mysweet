<?php
namespace application;

use hl\HLController;

class IndexController extends HLController
{
    public function index()
    {
        echo 'hello world!';
        for($i=0;$i<33;$i++){
            echo '<img src="mm/640 ('.$i.').webp" width="200px">';
        }
        for($i=0;$i<225;$i++){
            echo '<img src="mm/jpg/'.$i.'.jpg" width="200px">';
        }
    }
}
