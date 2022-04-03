<?php
use Illuminate\Database\Seeder;
use App\event_category;

class event_categories_Seeder extends Seeder {

    public function run()
    {
        //clear data
        event_category::truncate();

        $event_category = new event_category;
        $event_category->category = 'Event';
		$event_category->save();

        $event_category = new event_category;
        $event_category->category = 'Video';
        $event_category->save();

        $event_category = new event_category;
        $event_category->category = 'Link';
        $event_category->save();

        $event_category = new event_category;
        $event_category->category = 'Article';
        $event_category->save();

        $event_category = new event_category;
        $event_category->category = 'Image';
        $event_category->save();

        $event_category = new event_category;
        $event_category->category = 'News';
        $event_category->save();

        $event_category = new event_category;
        $event_category->category = 'Others';
        $event_category->save();
    }

}