<?php

class HomeController extends Controller {

    public function Index(){
        echo 'Домашняя страница';

       echo Storage::get('method');

    }


}