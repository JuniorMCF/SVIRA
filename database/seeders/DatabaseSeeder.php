<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create();
        //users
        foreach (range(1,3) as $index) {
	        DB::table('users')->insert([
                'dni' => $faker->numerify('########'),
	            'name' => $faker->name,
                'email' => $faker->email,
                'role' => $faker->randomElement($array = array('user','admin')),
                'password' => bcrypt('secret'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]);
	    }
        //profile
        $especialidades =Array("pediatria",'medicina general','otorrinolaringologia');

        $hospitales =Array("Arzobispo Loayza",'Dos de Mayo','San Bartolomé','José Casimiro Ulloa','Emergencias Pediátricas','Santa Rosa','Victor Larco Herrera','San Juan de Lurigancho','Rebagliati');


        foreach (range(1,3) as $index) {
	        DB::table('profiles')->insert([
                //'name'=> $faker->name,
                'age'=>$faker->randomNumber(2, true),
                'height'=>$faker->randomFloat(2, 160.00, 190.00),
                'weight'=>$faker->randomFloat(2, 50.00, 110.00),
                'phone_number'=>$faker->numerify('#########'),    
                'address'=>$faker->address,
                'reference'=>$faker->text,
                'especialidad' => $especialidades[array_rand($especialidades)],
            //foreign key with users table
                'user_id'=>$faker->randomElement($array = array(1,2,3)),
	        ]);
	    }
        

        //vaccines
        $vacunas = array("Sars-CoV-2",'Tuberculosis','Antihepatitis','Antipolio','Pentavalente',"Neumococo",'Rotavirus',"Influenza","Sarampión rubeola y paperas","Varicela","Influenza");

    	foreach ($vacunas as $vacuna) {
	        DB::table('vaccines')->insert([
	            'name' =>$vacuna,
	            'description' => $faker->text,
                'dosis' => $faker->randomDigitNotNull,
                'tipo' => $faker->randomElement($array = array('mensual','semestral','anual')),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]);
        }

        //farmaceuticas

        $farmaceuticas = array("Pfizer","Roche Group","Merck & Co.","Janssen","Novartis","Amgen","Gilead Sciencer","Novo Nordisk","AstraZeneca","GSK");
    	foreach ($farmaceuticas  as $farmaceutica) {
	        DB::table('farmaceuticas')->insert([
	            'name' => $farmaceutica,
	            'description' => $faker->text,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]);
        }
        

        
        foreach (range(1,7) as $index) {
	        DB::table('medicines')->insert([
	            'name' => $faker->name,
	            'description' => $faker->text,
	        ]);
	    }


        //especialidades
        
        foreach ($especialidades as $especialidad) {
	        DB::table('especialidads')->insert([
	            'name' => $especialidad,
	            'description' => $faker->text,
	        ]);
	    }

        //hospitales
        
        foreach ($hospitales as $hospital) {
	        DB::table('hospitals')->insert([
	            'name' => $hospital,
	            'description' => $faker->text,
	        ]);
	    }
    }
}
