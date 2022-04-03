<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

require 'UserTableSeeder.php';
require 'BranchListTableSeeder.php';
require 'EventsTableSeeder.php';
require 'event_categories_Seeder.php';
require 'settingsTableSeeder.php';
require 'AddPointsTableSeeder.php';
require 'event_branchTableSeeder.php';
require 'suggestionsTableSeeder.php';
require 'Our_Post_Seeder.php';
require 'BadWordSeeder.php';

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */


	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('BranchListTableSeeder');
		$this->command->info('branch_list table seeded!');

		$this->call('event_categories_Seeder');
		$this->command->info('Events Categories table seeded!');

		$this->call('EventsTableSeeder');
		$this->command->info('Events table seeded!');

		$this->call('eventBranchTableSeeder');
		$this->command->info('branch_location table seeded!');

		$this->call('SettingsTableSeeder');
		$this->command->info('Setting Table Seeded');

		$this->call('AddPointsTableSeeder');
		$this->command->info('Add Points Table Seeded');

		$this->call('suggestionsTableSeeder');
		$this->command->info('Suggestions Table Seeded');

		$this->call('Our_Post_Seeder');
		$this->command->info('Our Post Table Seeded');

		$this->call('BadWordSeeder');
		$this->command->info('BadWords Table Seeded');

	}

}

