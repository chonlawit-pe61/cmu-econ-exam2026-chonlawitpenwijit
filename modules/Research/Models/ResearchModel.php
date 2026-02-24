<?php

namespace Modules\Research\Models;

use CodeIgniter\Model;

class ResearchModel extends Model
{
    protected $table      = "";
    protected $primaryKey = "";
    protected $allowedFields = [];

    public function getResearch($input = '')
    {
        $builder = $this->db->table('Research');
        $builder->select('Research.*,ResearchType.name as research_type_name,ResearchType.description as research_type_description');
        $builder->join('ResearchType', 'Research.research_type = ResearchType.id', 'left');

        if (!empty($input['Title'])) {
            $builder->like('Research.title', $input['Title']);
        }
        if (!empty($input['research_type'])) {
            $builder->where('Research.research_type', $input['research_type']);
        }

        if (!empty($input['id'])) {
            $builder->where('Research.id', $input['id']);
            $data = $builder->get()->getRowArray();
        } else {
            $builder->where('deleted_at', null);
            $builder->where('status', 1);
            $builder->orderBy('publication_year', 'ASC');
            $data = $builder->get()->getResultArray();
        }
        return $data;
    }
    public function getResearchType()
    {
        $builder = $this->db->table('ResearchType');
        $builder->select('*');
        $data = $builder->get()->getResultArray();
        return $data;
    }
    public function deleteResearch($id)
    {
        $builder = $this->db->table('Research');
        $deleted_at = date('Y-m-d H:i:s');
        $builder->set('deleted_at', $deleted_at);
        $builder->where('id', $id);
        $builder->update();
    }

    public function checkTitle($input)
    {
        $builder = $this->db->table('Research');
        $builder->select('*');
        $builder->like('title', $input['title']);
        $builder->where('publication_year', $input['publication_year']);
        $data = $builder->get()->getResultArray();
        return $data;
    }


    public function manageResearch($input)
    {
        $builder = $this->db->table('Research');
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        if (!empty($input['id'])) {
            $builder->set('title', $input['title']);
            $builder->set('abstract', $input['abstract']);
            $builder->set('researcher_name', $input['researcher_name']);
            $builder->set('research_type', $input['research_type']);
            $builder->set('publication_year', $input['publication_year']);
            $builder->set('status', $input['status']);
            $builder->set('updated_at', $updated_at);
            $builder->where('id', $input['id']);
            $builder->update();
            return true;
        } else {
            $builder->set('title', $input['title']);
            $builder->set('abstract', $input['abstract']);
            $builder->set('researcher_name', $input['researcher_name']);
            $builder->set('research_type', $input['research_type']);
            $builder->set('publication_year', $input['publication_year']);
            $builder->set('status', $input['status']);
            $builder->set('created_at', $created_at);
            $builder->set('updated_at', $updated_at);
            $builder->insert();
            return true;
        }
    }
}
