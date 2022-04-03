<?php
use Illuminate\Database\Seeder;
use App\AddPoints;

class AddPointsTableSeeder extends Seeder {

    public function run()
    {
        //clear data
        AddPoints::truncate();

        $point = new AddPoints;
        $point->admin_id = 1036357483047530;
        $point->user_id = 7912382345453;
        $point->points = 60;
		$point->save();

        $point = new AddPoints;
        $point->admin_id = 1036357483047530;
        $point->user_id = 938173502861040;
        $point->points = '-50';
		$point->save();
        
        $point = new AddPoints;
        $point->admin_id = 1036357483047530;
        $point->user_id = 775995472469543;
        $point->points = 70;
		$point->save();
    }

}