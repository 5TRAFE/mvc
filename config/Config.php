<?php
class Config {
    static $css = 'template/css';
    static $js =  'template/js';
    static $cssCDN = [
        'https://fonts.googleapis.com/css?family=Marmelad',
        'https://fonts.googleapis.com/icon?family=Material+Icons',

    ];
    static $jsCDN = [
        'https://code.jquery.com/jquery-3.2.1.min.js',
    ];

    /**
     * @return array
     */
    static function Routes()
    {

        $routes = [

            'Users' => [

            '' => ['controller' => 'Home', 'action' => 'Index', 'method' => 'get'],

            'categories' => ['controller' => 'Category', 'action' => 'ViewAll', 'method' => 'get'],

            'categories/all/{params}' => ['controller' => 'Category', 'action' => 'ViewCategory', 'method' => 'get'],

            'view/{id}' => ['controller' => 'Product', 'action' => 'ShowProduct', 'method' => 'get'],

            ],

            'AdminRoutes' => [

                'admin' => ['controller' => 'Admin', 'action' => 'Index', 'method' => 'get'],

                'admin/categories' => ['controller' => 'Admin', 'action' => 'Categories', 'method' => 'get'],

                'admin/categories/edit/{id}' => ['controller' => 'Admin', 'action' => 'editCategory', 'method' => 'get'],

                'admin/category/update' => ['controller' => 'Admin', 'action' => 'updateCategory', 'method' => 'post'],

                'admin/products' => ['controller' => 'Admin', 'action' => 'Products', 'method' => 'get'],

                'admin/product/edit/{id}' => ['controller' => 'Admin', 'action' => 'editProduct', 'method' => 'get'],

            ]


        ];
        return $routes;
    }

    /**
     * return final routes
     */
    static function getRoutes()
    {
        $protected = self::Routes();
            $routes = [];
            foreach ($protected as $protect => $path) {

                foreach ($path as $key => $val) {
                    $key = explode('/', $key);
                    if (is_array($key)) {

                        if (in_array('{params}', $key)) {
                            array_pop($key);
                            $val['params'] = 'many';
                        } elseif ((in_array('{id}', $key))) {
                            array_pop($key);
                            $val['params'] = 'id';
                        }
                    }
                    $val['protected'] = $protect;
                    $key = implode($key, '/');
                    $routes[$key] = $val;
                }
            }
            return $routes;
        }


    /**
     * @return string
     */
    static function loadCss()
        {
            $cssDirectory = self::$css;
            $allowed_types = ['css'];
            $handle = @opendir($cssDirectory);
            $result = '';


            while (false !== ($file = readdir($handle))) {

                $file_parts = explode('.', $file);
                $css = strtolower(array_pop($file_parts));

                if (in_array($css, $allowed_types)) {

                    $result .= '<link rel="stylesheet" href="/' . $cssDirectory . '/' . $file . '"/>'. PHP_EOL;
                }
            }
            foreach (self::$cssCDN as $href){
                $result .= '<link rel="stylesheet" href="' . $href . '"/>' . PHP_EOL;

            }
            return $result;
        }

    /**
     * @return string
     */
    static function loadJs()
    {
        $result = '';

        foreach (self::$jsCDN as $href){
            $result .= '<script src="' . $href . '"></script>' . PHP_EOL;

        }

        $jsDirectory = self::$js;
        $allowed_types = ['js'];
        $handle = @opendir($jsDirectory);



        while (false !== ($file = readdir($handle))) {

            $file_parts = explode('.', $file);
            $js = strtolower(array_pop($file_parts));

            if (in_array($js, $allowed_types)) {

                $result .= '<script src="/' . $jsDirectory . '/' . $file . '"></script>'. PHP_EOL;
            }
        }

        return $result;
    }



}







