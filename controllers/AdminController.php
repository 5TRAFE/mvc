<?php
class AdminController extends Controller {
    private $admin;
    private $table;

    function __construct()
    {
        $this->admin = new Admin();
        $page = Storage::get('get');
        $page = $this->correctPage($page);
        $this->page = $page;
    }



    /**
     *
     */
    public function Index(){

        Page::render('admin');
    }

    /**
     *
     */
    public function categories(){
        $table = 'category';
        $limit = 9;
        $page = $this->page;

        $category =  $this->admin->getAll($table, $page, $limit);
        $total = $this->admin->getCount($table);
        $pagination = $this->paginate($total, $page, $limit);

        Page::render('admin.categories', ['categories' => $category, 'pagination' => $pagination]);
    }

    /**
     * @param $id
     */
    public function editCategory($id){
        $table = 'category';
        $id = $id[0];

        $category =  $this->admin->getSingle($table, $id);
        $array = $this->admin->categoriesSelects($id);
        Page::render('admin.categories.edit', ['category' => $category, 'array' => $array,]);

    }

    /**
     *
     */
    public function updateCategory(){

        $this->admin->updateCategory();

         Page::redirect(Storage::get('redirect'));

    }


    public function Products(){
        $table = 'products';
        $page = $this->page;
        $limit = 6;
        $products = $this->admin->getAll($table, $page, $limit);

        $total = $this->admin->getCount($table);
        $pagination = $this->paginate($total, $page, $limit);
        Page::render('admin.products', ['products' => $products, 'pagination' => $pagination]);

    }

}