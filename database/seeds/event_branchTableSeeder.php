<?php
use Illuminate\Database\Seeder;
use App\event_branch;

class eventBranchTableSeeder extends Seeder {

    public function run()
    {
        //clear data
        event_branch::truncate();

        $oneday = (60 * 60 * 24);
    	$totalid = 0;
        $startday = -4;
    	for ($i=1; $i <= 7; $i++) { 
    		for ($j=1; $j <= 3; $j++) { 
    			$totalid++;
		        $event_branch = new event_branch;
		        $event_branch->events_id = $i;
		        $event_branch->branch_id = $j;
                $event_branch->event_date = date("Y-m-d H:i:s", time() + ($oneday * ($startday + $i)));
				$event_branch->save();
    		}
    	}

        $event_branch = new event_branch;
        $event_branch->events_id = 8;
        $event_branch->branch_id = 3;
        $event_branch->event_date = date("Y-m-d H:i:s", time() - ($oneday * 2));
		$event_branch->save();

        $event_branch = new event_branch;
        $event_branch->events_id = 9;
        $event_branch->branch_id = 3;
        $event_branch->event_date = date("Y-m-d H:i:s", time() - ($oneday * 3));
		$event_branch->save();

        $event_branch = new event_branch;
        $event_branch->events_id = 10;
        $event_branch->branch_id = 3;
        $event_branch->event_date = date("Y-m-d H:i:s", time() - ($oneday * 4));
		$event_branch->save();
   
    }

}