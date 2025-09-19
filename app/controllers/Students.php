<?php

class Students extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('Student_model', 'student');
        $this->call->library('pagination');
        $this->call->helper('url');
        
        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'nav'    => 'flex justify-center mt-6',
            'ul'     => 'inline-flex items-center space-x-1',
            'li'     => 'inline',
            'a'      => 'px-3 py-1 rounded-md border border-gray-300 text-gray-700 bg-white hover:bg-blue-500 hover:text-white transition',
            'active' => 'px-7 py-1 rounded-md border border-blue-500 bg-blue text-black font-bold'
        ]);

    }

    public function index($page = 1)
    {
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) {
            $per_page = 10;
        }

        // Handle search (from query string)
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        // Count rows
        $total_rows = $this->student->count_all_records($search);

        // Init pagination
        $pagination_data = $this->pagination->initialize(
            $total_rows,
            $per_page,
            $page,
            'students/index',
            5
        );

        // Get records
        $data['students'] = $this->student->get_records_with_pagination($pagination_data['limit'], $search);
        $data['total_records'] = $total_rows;
        $data['pagination_data'] = $pagination_data;
        $data['pagination_links'] = $this->pagination->paginate();
        $data['search'] = $search;

        $this->call->view('students/index', $data);
    }

    public function create()
    {
        if ($_POST) {
            $this->student->insert_student([
                'lastname'  => $_POST['lastname'],
                'firstname' => $_POST['firstname'],
                'email'     => $_POST['email']
            ]);
            redirect('students');
        }
        $this->call->view('students/create');
    }

    public function edit($id)
    {
        if ($_POST) {
            $this->student->update_student($id, [
                'lastname'  => $_POST['lastname'],
                'firstname' => $_POST['firstname'],
                'email'     => $_POST['email']
            ]);
            redirect('students');
        }
        $data['student'] = $this->student->get_student($id);
        $this->call->view('students/edit', $data);
    }

    public function delete($id)
    {
        $this->student->delete_student($id);
        redirect('students');
    }
}
