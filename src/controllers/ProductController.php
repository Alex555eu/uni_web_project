<?php

//require_once "AppController.php";
require_once __DIR__."/../../autoload.php";

class ProductController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', 'image/webp'];
    const UPLOAD_DIRECTORY = '/../public/images/product_images/';

    private $message = [];
    private $productRepository;

    public function __construct() {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }

    public function select_product(string $argument) {
        $argument = intval(filter_var($argument, FILTER_SANITIZE_NUMBER_INT)); // returns 0 on failure
        if ($argument != 0) {
            $products = $this->productRepository->getProductById($argument);
            $this->render('select_product', ['product' => $products]);
        }
        else
            die("Wrong url!");
    }

    public function deleteProduct(string $argument) {
        $argument = intval(filter_var($argument, FILTER_SANITIZE_NUMBER_INT)); // returns 0 on failure
        if ($argument != 0) {
            $path = $this->productRepository->deleteProduct($argument);

            if (!is_null($path)) {
                $old_file = dirname(__DIR__) . '/../' . $path;
                if (file_exists($old_file))
                    unlink($old_file);
            }
        }
        else {
            die("Wrong url!");
        }
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/modify_product");
    }


    public function modifyProduct() {
        if (!$this->isPost()) {
            return;
        }
        $trimmedPath = $_POST['original_file_path'];

        if(is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            $new_file_name = time() . $_FILES['file']['name'];
            $path = self::UPLOAD_DIRECTORY . $new_file_name;
            $trimmedPath = substr($path, strpos($path, '/', 1));
            $trimmedPath = trim($trimmedPath, '/');

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).$path
            );

            //$modifiedProduct = new Product($_POST['product_id'], $_POST['name'], $_POST['price'], $trimmedPath, $_POST['description'], 2, $_POST['quantity']);
            $modifiedProduct = $this->productRepository->getProductById($_POST['product_id']);
            $modifiedProduct->setName($_POST['name']);
            $modifiedProduct->setPrice($_POST['price']);
            $modifiedProduct->setDescription($_POST['description']);
            $modifiedProduct->setImage($trimmedPath);
            $modifiedProduct->getProductInventory()->setTotalQuantityInStore($_POST['quantity']);

            $tmp = $this->productRepository->modifyProduct($modifiedProduct);

            if (is_null($tmp)) {
                $uploaded_file = dirname(__DIR__).$path;
                if (file_exists($uploaded_file))
                    unlink($uploaded_file);
            } else {
                $old_file = dirname(__DIR__) . '/../' . $_POST['original_file_path'];
                if (file_exists($old_file))
                    unlink($old_file);
            }
        } else {
            $modifiedProduct = $this->productRepository->getProductById($_POST['product_id']);
            $modifiedProduct->setName($_POST['name']);
            $modifiedProduct->setPrice($_POST['price']);
            $modifiedProduct->setDescription($_POST['description']);
            $modifiedProduct->setImage($trimmedPath);
            $modifiedProduct->getProductInventory()->setTotalQuantityInStore($_POST['quantity']);

            $this->productRepository->modifyProduct($modifiedProduct);
        }

        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/modify_product");
    }


    public function search() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200) ;

            echo json_encode($this->productRepository->getProducts($decoded['search_category'], $decoded['search_store'], $decoded['search']));

        }
    }


    public function addProduct() {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            $new_file_name = time() . $_FILES['file']['name'];
            $path = self::UPLOAD_DIRECTORY . $new_file_name;
            $trimmedPath = substr($path, strpos($path, '/', 1));
            $trimmedPath = trim($trimmedPath, '/');

            $product = new Product(-1, $_POST['name'], $_POST['description'], $_POST['price'], $trimmedPath, null, null);
            $tmp = $this->productRepository->addNewProduct($product, $_POST['quantity'], $_POST['store_id'], $_POST['category_id']);

            if (is_null($tmp)) {
                $this->message[] = 'failed to add new product';
            }
            else {
                $this->message[] = 'success';
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__).$path
                );
            }
        }
        //return $this->render('add_product', ['messages' => $this->message]);
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/modify_product");
    }

    private function validate(array $file): bool {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }







}