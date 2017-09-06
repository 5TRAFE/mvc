<?php
class CategoryController extends Controller {

    public function ViewAll(){
        echo 'это все категории';


    }
    public function ViewCategory($params){
        echo 'єто категория';
        $request = strtolower(trim(implode($params, '/')));
       // echo  $request . '<br>';

        $id = $this->findCategory(Storage::get('categories'), $request);
        if($id === false){
            Page::get404();
        }
        echo $id;
        $category = Categories::ViewCategory($id);
        print_r($category);
        Page::render('layouts/footer');
    }

}