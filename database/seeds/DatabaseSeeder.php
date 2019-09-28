<?php

use Illuminate\Database\Seeder;
use App\contactinfo;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        // contactinfo::create([
        //     'email'=> 'kashousing@gmail.com',
        //     'phone'=> '8870050001',
        //     'address'=> '3/408-f,1st floor,Near Malarmaligai, Krishna Nagar,Iyer Bungalow,Madurai - 625014',
        //     'map1'=> 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d125746.3649917683!2d78.137822!3d9.969364!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x65cc78f2d42a2bf0!2sKAS+Housing!5e0!3m2!1sen!2sin!4v1553799700767!5m2!1sen!2sin',
        //     'map2'=> 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d125746.3649917683!2d78.137822!3d9.969364!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x65cc78f2d42a2bf0!2sKAS+Housing!5e0!3m2!1sen!2sin!4v1553799700767!5m2!1sen!2sin',
        //     'described'=> 'K.A.S housing Pvt.Ltd,company has been founded by Mr.K.Alagarsamy at 1990 by implementing and constructing the indiviual residential villas and Commercial purpose building with high level construction method with proper alignment of labor and work quality with well-designed aechitecture',
        //     ]);
            Admin::create([
            'emp_name'=> 'prasanth',
            'email'=> 'prasanthats@gmail.com',
            'phone'=>'7010384622',
            'role_id'=>'1',
            'password'=>Hash::make('7010384622')
                ]);
    }
}
