<?php
use Illuminate\Database\Seeder;
use App\Branch_list;

class BranchListTableSeeder extends Seeder {

    public function run()
    {
        //clear data
        Branch_list::truncate();

        $branches = new Branch_list;
        $branches->branch_name = 'Global Branch (for testing)';
        $branches->facebook_id = '1036357483047530';
        $branches->city = 'Global';
        $branches->save();

        $branches = new Branch_list;
        $branches->branch_name = 'Trinoma Mall';
        $branches->facebook_id = '1377990025844187';
        $branches->city = 'Quezon City';
        $branches->save();

        $branches = new Branch_list;
        $branches->branch_name = 'E. Rodriguez Sr. Ave';
        $branches->facebook_id = '775995472469543';
        $branches->city = 'Quezon City';
        $branches->save();

        $branches = new Branch_list;
		$branches->branch_name = 'SM Southmall';
		$branches->facebook_id = '1378181122491476';
        $branches->city = 'South';
		$branches->save();

    }

}