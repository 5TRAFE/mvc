<?php

Class Admin extends Model {




    public function categoriesSelects($id = 0){
        $db = $this->db;
        $result = $db->query('SELECT * FROM category');
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $array = Categories::form_tree($result);
        $array = $this->select($array, $id);

        return $array;

    }

    private function select($shop_categories, $id, $prefix = "")
    {
        static $build = '';
        foreach ($shop_categories as $element) {
            if($element['id'] == $id && $element['parent_id'] == 0){
                $build .= '<option value="0" selected>' .$element['category_name'] . ' (Корневая категория)</option>' . PHP_EOL;
            }else {
                if ($element['id'] == $id) {
                $build .= '<option value="' . $element['parent_id'] . '"';
                    $build .= ' selected';
                    $build .= '>' . $prefix . $element['category_name'] . '</option>' . PHP_EOL;
                }else {
                    $build .= '<option value="' . $element['id'] . '"';
                    $build .= '>' . $prefix . $element['category_name'] . '</option>' . PHP_EOL;
                }
            }
            if (array_key_exists('children', $element)) {
                $this->select($element['children'], $id, "-" . $prefix);
            }
        }
        return $build;
    }

    public function updateCategory(){

        $db = $this->db;

        $data = Storage::get('post');
        $id = $data['id'];
        $parent = $data['parent_id'];
        $url = $data['url'];
        $redirect = $data['redirect'];
        Storage::set('redirect', $redirect);

        if(!($this->checkUniqueAlias($id, $parent, $db, $url))){
            return false;
        }

        $db = $db->prepare('UPDATE category SET category_name = :name, parent_id = :parent, url = :url, category_description = :description WHERE id=' . $id);
        $values = [
          'name' => $data['category_name'],
          'parent' => $parent,
          'url' => $url,
          'description' => $data['category_description'],
        ];
        $db->execute($values);
        Sessions::setMessage('Категория успешно обновлена!');
        return true;

    }

    private function checkUniqueAlias($id, $parent, $db, $url){

       $result = $db->query('SELECT url FROM category WHERE parent_id =' . $parent . ' AND id !=' . $id);
       $result = $result->fetchAll(PDO::FETCH_ASSOC);
       foreach ($result as $val){
           if(strtolower($val['url']) == strtolower($url)){
               Sessions::setError('Алиас должен быть уникален для своей подкатегории!');
               return false;
           }
       }
       return true;

    }



}