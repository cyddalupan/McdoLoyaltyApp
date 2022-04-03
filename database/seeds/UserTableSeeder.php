<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        //clear data
        User::truncate();

        $user = new User;
        $user->facebook_id = 1374713106171146;
        $user->name = 'Joe Wongescus';
        $user->gender = 'male';
        $user->birthday = '1980-08-08';
        $user->points = 30;
        $user->rewards = 5;
        $user->long_access_token = 'CAAEeOfIyQCMBAFTZBvizabZCzVZBgw8JXXaKwgoulmKOaS8hCZA4jyaBEwwf3jslG2Qp9nN8R4CMfVNXfFq4R5YqXhXSd8ATdLjPMZCXUQfXxZAiE1xZCF2p2fVaWxP7PpyEEGx9yPd0wGEXNMi4JxCSg5IRxb2QDOKDRJaLKJAxs4b8uZBoQKZAUv4q1O5WfDZCYZD';
        $user->user_type = 'xuser';
        $user->branch_id = 3;
        $user->post_to_my_wall = 'no';
		$user->save();

        $user = new User;
        $user->facebook_id = 1377990025844187;
        $user->name = 'Voldemort Dingleberg';
        $user->gender = 'male';
        $user->birthday = '1980-08-08';
        $user->points = 40;
        $user->rewards = 7;
        $user->long_access_token = 'CAAEeOfIyQCMBAGaCVIUxvHhZCkpWi3hhkAib6hWGG6AX57z0KoIUhNQTO7GJI20OU8VpL8iDTwIaQ8t2dtfiMGTgY3ogIbMlGbXM6GyC0psuaw1jzZBiIg3iruBfoqlMTt7jhUiwLYraUHv5Gq9XitCrq2h8u85iqruMSsxd0CdGRjFJh9';
        $user->user_type = 'branchManager';
        $user->branch_id = 0;
        $user->post_to_my_wall = 'no';
		$user->save();

        $user = new User;
        $user->facebook_id = 1378304342479172;
        $user->name = 'Nemo Shepardsky';
        $user->gender = 'female';
        $user->birthday = '1980-08-08';
        $user->points = 50;
        $user->rewards = 9;
        $user->long_access_token = 'CAAEeOfIyQCMBAFnQZBgNVQZCR0olNz40692TcTyNjl2WoRdU6oN4pViXH7PSCEomQ3NVnuESauGd8stNhkfDd3BZCZAcyDZBhqPv5OkH8h59V17U1d2ZBn3MWfUonHyD2buWEibJz0a9WsmyDZC2HcwrgrwZA0465xZA37sWsLAVjtHeSt0thyxNpUjTVdn4vZCaQZD';
        $user->user_type = 'branchManager';
        $user->branch_id = 0;
        $user->post_to_my_wall = 'yes';
		$user->save();

        $user = new User;
        $user->facebook_id = 1378181122491476;
        $user->name = 'Pikachu Occhinoson';
        $user->gender = 'female';
        $user->birthday = '1980-08-08';
        $user->points = 60;
        $user->rewards = 7;
        $user->long_access_token = 'CAAEeOfIyQCMBAFnQZBgNVQZCR0olNz40692TcTyNjl2WoRdU6oN4pViXH7PSCEomQ3NVnuESauGd8stNhkfDd3BZCZAcyDZBhqPv5OkH8h59V17U1d2ZBn3MWfUonHyD2buWEibJz0a9WsmyDZC2HcwrgrwZA0465xZA37sWsLAVjtHeSt0thyxNpUjTVdn4vZCaQZD';
        $user->user_type = 'branchManager';
        $user->branch_id = 0;
        $user->post_to_my_wall = 'yes';
		$user->save();

        $user = new User;
        $user->facebook_id = 775995472469543;
        $user->name = 'Fred Zilla';
        $user->gender = 'male';
        $user->birthday = '1992-11-23';
        $user->points = 361;
        $user->rewards = 37;
        $user->long_access_token = 'CAAEeOfIyQCMBAL6R9PkICbeoLqv7ZBCETelxsIAgtZCsAAynZCSP0NZBOhUTUllm8FCzSKnoCNTPZCGBvoX54Idkpjz1QBA2USxVh9EVphP4UTUuOKJGMkn5TKKtcW4FIovMyHx5tVZCtPGuHzZAZAw8TstamF0R7bsbHy4UXcUphdCWdNMn8oMlfqxj4B7BuvAZD';
        $user->user_type = 'branchManager';
        $user->branch_id = 3;
        $user->post_to_my_wall = 'yes';
		$user->save();

        $user = new User;
        $user->facebook_id = 938173502861040;
        $user->name = 'Hanz Olvarra';
        $user->gender = 'male';
        $user->birthday = '1992-06-15';
        $user->points = 153;
        $user->rewards = 23;
        $user->long_access_token = 'CAAEeOfIyQCMBAEsKS3ZBJtoXx8t40D3q4SOkgOD8ZCRmELp8bDNodJkcdkRn5xITvuAtTfBmE630YCgIrpxSZAPT89TtVwzQrYFDanDl0JlfFafvewpoa4mXfHqPdhxlDPULQrDdyGVNch56WZB52Dpgh1ZCw0t2omz1GDfYbaXSd1RIMFAWl';
        $user->user_type = 'admin';
        $user->branch_id = 3;
        $user->post_to_my_wall = 'yes';
		$user->save();

        $user = new User;
        $user->facebook_id = 7912382345453;
        $user->name = 'Haru maka';
        $user->gender = 'male';
        $user->birthday = '1992-06-15';
        $user->points = 222;
        $user->rewards = 16;
        $user->long_access_token = 'CAAEeOfIyQCMBAEsKS3ZBJtoXx8t40D3q4SOkgOD8ZCRmELp8bDNodJkcdkRn5xITvuAtTfBmE630YCgIrpxSZAPT89TtVwzQrYFDanDl0JlfFafvewpoa4mXfHqPdhxlDPULQrDdyGVNch56WZB52Dpgh1ZCw0t2omz1GDfYbaXSd1RIMFAWl';
        $user->user_type = 'xuser';
        $user->branch_id = 3;
        $user->post_to_my_wall = 'no';
		$user->save();

        $user = new User;
        $user->facebook_id = 7912382345454;
        $user->name = 'jane go';
        $user->gender = 'female';
        $user->birthday = '1992-06-15';
        $user->points = 223;
        $user->rewards = 14;
        $user->long_access_token = 'CAAEeOfIyQCMBAEsKS3ZBJtoXx8t40D3q4SOkgOD8ZCRmELp8bDNodJkcdkRn5xITvuAtTfBmE630YCgIrpxSZAPT89TtVwzQrYFDanDl0JlfFafvewpoa4mXfHqPdhxlDPULQrDdyGVNch56WZB52Dpgh1ZCw0t2omz1GDfYbaXSd1RIMFAWl';
        $user->user_type = 'xuser';
        $user->branch_id = 3;
        $user->post_to_my_wall = 'no';
		$user->save();
    }

}