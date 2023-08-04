<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    public function index()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/serviceAccount.json')
            ->withDatabaseUri('https://leuleu-12458-default-rtdb.asia-southeast1.firebasedatabase.app/');

        $database = $firebase->createAuth();

        return $database;
    }
}