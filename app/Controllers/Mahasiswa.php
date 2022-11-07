<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswa;

    function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
    }

    public function index()
    {
        $data['mahasiswa'] = $this->mahasiswa->findAll();
        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function store()
    {
        if (!$this->validate([
            'nim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'valid_email' => 'Email Harus Valid'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->mahasiswa->insert([
            'nim' => $this->request->getVar('nim'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'no_telp' => $this->request->getVar('no_telp'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat')
        ]);
        session()->setFlashdata('message', 'Tambah Data Mahasiswa Berhasil');
        return redirect()->to('/mahasiswa');
    }

    function edit($id)
    {
        $dataMahasiswa = $this->mahasiswa->find($id);
        if (empty($dataMahasiswa)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Mahasiswa Tidak ditemukan !');
        }
        $data['mahasiswa'] = $dataMahasiswa;
        return view('mahasiswa/edit', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'nim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'valid_email' => 'Email Harus Valid'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],

        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }

        $this->mahasiswa->update($id, [
            'nim' => $this->request->getVar('nim'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'no_telp' => $this->request->getVar('no_telp'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat')
        ]);
        session()->setFlashdata('message', 'Update Data Mahasiswa Berhasil');
        return redirect()->to('/mahasiswa');
    }
    function delete($id)
    {
        $dataMahasiswa = $this->mahasiswa->find($id);
        if (empty($dataMahasiswa)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Mahasiswa Tidak ditemukan !');
        }
        $this->mahasiswa->delete($id);
        session()->setFlashdata('message', 'Delete Data Mahasiswa Berhasil');
        return redirect()->to('/mahasiswa');
    }
}
