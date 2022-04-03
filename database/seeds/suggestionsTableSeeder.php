<?php
use Illuminate\Database\Seeder;
use App\suggestions;

class suggestionsTableSeeder extends Seeder {

    public function run()
    {   
        suggestions::truncate();

        $suggestions = new suggestions;
		$suggestions->code_name = 'CodeNameCyd';
		$suggestions->description = 'Seed1 first suggestion';
		$suggestions->facebook_id = 1036357483047530;
		$suggestions->save();

        $suggestions = new suggestions;
		$suggestions->code_name = 'Baldemor';
		$suggestions->description = 'Seed2 yusuku natuwara hayatikuhal balin yku si amen tarada';
		$suggestions->facebook_id = 1377990025844187;
		$suggestions->save();

        $suggestions = new suggestions;
		$suggestions->code_name = 'Pikapii';
		$suggestions->description = 'Seed3 Pika Pika Pika ';
		$suggestions->facebook_id = 1378181122491476;
		$suggestions->save();

        $suggestions = new suggestions;
		$suggestions->code_name = '';
		$suggestions->description = 'Seed4 blub. blub blub blub.';
		$suggestions->facebook_id = 1378304342479172;
		$suggestions->save();

        $suggestions = new suggestions;
        $suggestions->code_name = 'newmow';
        $suggestions->description = 'Seed5 blooooooob';
        $suggestions->facebook_id = 1378304342479172;
        $suggestions->deleted_at = date('Y-m-d');
        $suggestions->save();

    }

}