<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class HomeCustomerController extends Controller
{
    public function home()
    {
        $data['car'] = Car::join('car_images', 'car_images.car_id', '=', 'cars.id')
            ->join('manufactures', 'manufactures.id', '=', 'cars.manufacture_id')
            ->select('cars.*', 'car_images.image', 'manufactures.name as merk')
            ->latest()
            ->take(3)
            ->where('cars.status', 'tersedia')
            ->get();

        $data['active'] = 'home';
        return view('customer.home', $data);
    }

    public function car()
    {
        $data['car'] = Car::join('car_images', 'car_images.car_id', '=', 'cars.id')
            ->join('manufactures', 'manufactures.id', '=', 'cars.manufacture_id')
            ->select('cars.*', 'car_images.image', 'manufactures.name as merk')
            ->where('cars.status', 'tersedia')->get();
        $data['active'] = 'car';
        return view('customer.car', $data);
    }

    public function transaction($id)
    {
        dd('hi');
    }
}
