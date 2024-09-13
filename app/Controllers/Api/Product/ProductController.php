<?php

namespace App\Controllers\Api\Product;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Product\ProductModel;
use App\Controllers\Api\User\UserLogin;

class ProductController extends BaseController
{
    public function index()
    {
        //
    }

    public function createProduct(){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');
    
        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
        $ProductModel = new ProductModel($db);

        $productData = [
            'ProductName' => $this->request->getVar('ProductName'),
            'Description' => $this->request->getVar('Description'),
            'MarketingMessage' => $this->request->getVar('MarketingMessage'),
            'CreatedBy' => $this->request->getVar('CreatedBy'),
            'CreatedOn' => $this->request->getVar('CreatedOn'),
            'UpdatedBy' => $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => $this->request->getVar('UpdatedOn')
        ];

        if($ProductModel->save($productData)){
            return $this->response->setJSON([
                'status'=>200,
                'message'=>'Product Created Successfully',
                'data'=>$productData
            ]);
        }
        return $this->response->setJSON([
            'status'=>500,
            'message'=>'Failed to Create Product'
        ]);
    }

    public function updateProduct($id){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');
    
        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
        $ProductModel = new ProductModel($db);

        $updateData = [
            'ProductName'=> $this->request->getVar('ProductName'),
            'Description'=> $this->request->getVar('Description'),
            'MarketingMessage'=> $this->request->getVar('MarketingMessage'),
            'CreatedBy'=> $this->request->getVar('CreatedBy'),
            'CreatedOn' => date('Y-m-d'),
            'UpdatedBy'=> $this->request->getVar('UpdatedBy'),
            'UpdatedOn' => date('Y-m-d'),
        ];

        if($ProductModel->update($id,$updateData)){
            return $this->response->setJSON([
                'status'=>200,
                'message'=>'Product Updated Successfully',
                'data'=>$updateData
            ]);
        }
        return $this->response->setJSON([
            'status'=>500,
            'message'=>'Failed to Update Product'
        ]);
    }

    public function getAllProduct(){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
        $ProductModel = new ProductModel($db);

        $result = $ProductModel->findAll();

        if($result){
            return $this->response->setJSON([
                'status'=>200,
                'message'=>'Products Fetched Successfully',
                'data'=>$result
            ]);
    
            }
        return $this->response->setJSON([
            'status'=>500,
            'message'=>'Failed to Fetch Products'
        ]);

    }

    public function deleteProduct($id){
        $dbname = $this->request->getVar('DBNAME');
        $uname = $this->request->getVar('UNAME');
        $pass = $this->request->getVar('PASS');
        $host = $this->request->getVar('HOST');

        $connect=new UserLogin();
        $dbconnectarray = $connect->generateDBarray($dbname, $uname, $pass, $host);
        $db = \Config\Database::connect($dbconnectarray);
        $ProductModel = new ProductModel($db);

        if($ProductModel->delete($id)){
            return $this->response->setJSON([
                'status'=>200,
               'message'=>'Product Deleted Successfully'
            ]);
        }
        return $this->response->setJSON([
            'status'=>500,
           'message'=>'Failed to Delete Product'
        ]);
        

    }

}
