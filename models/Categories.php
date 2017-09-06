<?php

Class Categories {


    static function addCategory($name, $parent, $url)
    {

        $db = DB::getConnection();

            $add = $db->prepare('INSERT INTO  category (category_name, parent_id, url) VALUES (:name, :parent, :url)');
            $values = [
                'name' => $name,
                'parent' => $parent,
                'url' => $url,
            ];

            $add->execute($values);



    }

      static function build(){
        $db = DB::getConnection();
        $result = $db->query('SELECT * FROM category');
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $array = self::form_tree($result);



        $result = self::build_tree($array);
        Storage::set('categories', $array);
        return $result;
    }



   static function build_tree(&$category, $url = '')
    {
         static $menu = '';

        foreach ($category as &$item) {
            if (array_key_exists('children', $item)) {

                $url .= '/' . trim($item['url']);
                $item['url'] = $url;

                $menu .=  '<li class="has-sub "><a href="/categories/all'. $item['url'] . '">' . $item['category_name'] .  ' <i class="fa fa-angle-down"></i></a>
                <ul class="">';

                self::build_tree($item['children'], $url);
            }else
            {
                $url .= '/' . trim($item['url']);
                $item['url'] = $url;

                $menu .= '<li class="dropdown"><a href="/categories/all'. $item['url'] . '">' .  $item['category_name'] . '</a></li></li>';
            }

            $url = explode('/',$url);
            array_pop($url);
            $url = implode($url, '/');

        }

        $menu .= '</ul>';
        return $menu;
    }

   static function form_tree($a ,$i = 'id', $p='parent_id',$r=0,$c='children'){
        if (!is_array($a)) return false;     // Внутренняя рекурсивная функция
           function tree_node($index,$root,$cn) {
               $_ret = [];
               foreach ($index[$root] as $k => $v) {
                   $_ret[$k] = $v;
                   if (isset($index[$k])) $_ret[$k][$cn] = tree_node($index,$k,$cn);
               }       return $_ret;
           }       $ids = []; // Временный индексный массив     // Создаём временные массивы на корректные элементы
            foreach ($a as $k => $v) {
                if (is_array($v)) {
                    if ((isset($v[$i]) || ($i === false)) && isset($v[$p])) {
                        $key = ($i === false)?$k:$v[$i];
                        $parent = $v[$p];
                        $ids[$parent][$key] = $v;
                    }
                }
            }
            return (isset($ids[$r]))?tree_node($ids,$r,$c):false;
    }


        static function ViewCategory($id){
            $db = DB::getConnection();
            $result = $db->query('SELECT * FROM category WHERE id=' .$id);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }




}