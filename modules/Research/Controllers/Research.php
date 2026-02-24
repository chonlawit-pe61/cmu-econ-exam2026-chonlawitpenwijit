<?php

namespace Modules\Research\Controllers;

use App\Controllers\BaseController;
use Modules\Research\Models\ResearchModel;

/**
 *
 */
class Research extends BaseController
{
  public function index()
  {
    $ResearchModel = new ResearchModel();
    $input = $this->request->getGet();
    $data['research'] = $ResearchModel->getResearch($input);
    $data['getResearchType'] = $ResearchModel->getResearchType();
    return view('Modules\Research\Views\index.php', $data);
  }
  public function create()
  {
    $ResearchModel = new ResearchModel();
    $data['getResearchType'] = $ResearchModel->getResearchType();

    return view('Modules\Research\Views\form.php', $data);
  }
  public function edit($id)
  {
    $ResearchModel = new ResearchModel();
    $input['id'] = $id;
    $data['research'] = $ResearchModel->getResearch($input);
    $data['getResearchType'] = $ResearchModel->getResearchType();


    return view('Modules\Research\Views\form.php', $data);
  }
  public function deleteResearch()
  {
    $input = $this->request->getPost();
    $ResearchModel = new ResearchModel();
    $ResearchModel->deleteResearch($input['id']);
    // return redirect()->to(base_url('research'));
  }
  public function checkTitle()
  {
    $input = $this->request->getPost();
    $ResearchModel = new ResearchModel();

    $result = $ResearchModel->checkTitle($input);
    if (!empty($result)) {
      return json_encode(array('status' => 'error', 'message' => 'มีชื่องานวิจัยนี้แล้ว'));
    } else {
      return json_encode(array('status' => 'success', 'message' => 'ไม่พบชื่องานวิจัยนี้'));
    }
  }
  public function saveResearch()
  {
    $session = session();
    $input = $this->request->getPost();
    $ResearchModel = new ResearchModel();
    $result =  $ResearchModel->manageResearch($input);
    if ($result == false) {
      $session->setFlashdata('msg', 'ห้ามซ้ำภายในปีเดียวกัน');
      return redirect()->to(base_url('research'));
    } else {
      return redirect()->to(base_url('research'))->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
  }

  public function researchView($id)
  {
    $ResearchModel = new ResearchModel();
    $input['id'] = $id;
    $data['research'] = $ResearchModel->getResearch($input);
    return view('Modules\Research\Views\detail.php', $data);
  }
}
