<?php

namespace App\Controllers\Api\org;

use App\Controllers\BaseController;
use App\Models\org\OrganizationModel;


class OrganizationController extends BaseController
{
    private $jwtSecret = 'fdsfsdf684454dgsgs464545646gs64461'; 
    public function getorgdtls()
    {
        $orgmodel = new OrganizationModel();

        $orgcode =$this->request->getVar('orgcode');

        $orgdata = $orgmodel->where('OrgCode', $orgcode)->findAll();

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Organization data featched successfully',
            'data' => $orgdata
        ]);
     

    }
}
