<?php

use Illuminate\Database\Seeder;

class adminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //we need record to add admin table
       // DB::table('admins')->delete();
        $adminRecords = [['id'=>1,'name'=>'admin','type'=>'admin','contact'=>'7508050111','email'=>'vishal@gmail.com','password'=>bcrypt('12345678'),'image'=>'','status'=>1],
        ];//insert all data here //we can insert many records also

         $adminRecords = [['id'=>2,'name'=>'vishal','type'=>'subadmin','contact'=>'98989898009','email'=>'v@gmail.com','password'=>bcrypt('12345678'),'image'=>'','status'=>1],
        ];

        //foreach ($adminRecords as $key => $record) {
        //	 \App\admin::create($record);
         //}
        DB::table('admins')->insert($adminRecords);
        
    }
}
