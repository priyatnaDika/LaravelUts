<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
      $title="Data Mahasiswa";
      $data['mahasiswa']=array(
        'nim'=>'123',
        'nama'=>'budi'
      );
      $data['user']='';
      return view('admin.beranda', compact('title','data'));
  }
  public function dasboard()
  {
      $title="Dasboard";

      return view('admin.dasboard', compact('title'));
  }
}