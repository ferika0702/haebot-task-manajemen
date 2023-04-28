<?php

namespace App\Controllers;
use App\Models\TaskModel;
use CodeIgniter\RESTful\ResourceController;

class Task extends ResourceController
{


    public function index()
    {
        $modelTask = new TaskModel();
        $task      = $modelTask->findall();

        $data = [
            'task' => $task
        ];

        return view('list_task/index', $data);
    }

    
    public function show($id = null)
    {
        //
    }

    
    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelTask = new TaskModel();
            $task = $modelTask->findAll();

            $data = [
                'task'        => $task,
            ];

            $json = [
                'data'          => view('list_task/add', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

   
    public function create()
    {
        if ($this->request->isAJAX()) {

            $validasi = [
                'nama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'nama harus diisi',
                    ]
                ],
            ];

            if (!$this->validate($validasi)) {
                $validation = \Config\Services::validation();

                $error = [
                    'error_nama' => $validation->getError('nama'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                $modelTask = new TaskModel();

                $data = [
                    'nama' => $this->request->getPost('nama'),
                ];
                $modelTask->save($data);
                $json = [
                    'success' => 'Berhasil menambah data task'
                ];
            }
            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function edit($id = null)
    {
        if ($this->request->isAJAX()) {
            $modelTask = new TaskModel();
            $task      = $modelTask->find($id);

            $data = [
                'task' => $task,
            ];
            $json = [
                'data' => view('list_task/edit', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function update($id = null)
    {
        $validasi = [
            'nama'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'nama harus diisi',
                ]
            ],
        ];

        if (!$this->validate($validasi)) {
            $validation = \Config\Services::validation();

            $error = [
                'nama' => $validation->getError('nama'),
            ];

            $json = [
                'error' => $error
            ];
        } else {
            $modelTask = new TaskModel();

            $data = [
                'id' => $id,
                'nama' => $this->request->getPost('nama'),
                'start_time' => $this->request->getPost('start_time'),
                'end_time' => $this->request->getPost('end_time'),
                'status' => $this->request->getPost('status'),
                'list_frequency' => $this->request->getPost('list_frequency'),
                'list_absen' => $this->request->getPost('list_absen'),
            ];
            $modelTask->save($data);

            $json = [
                'success' => 'Berhasil Update data Task'
            ];
        }
        echo json_encode($json);
    }


    public function delete($id = null)
    {
        //
    }
}
