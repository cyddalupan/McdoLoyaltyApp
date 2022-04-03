<?php
use Illuminate\Database\Seeder;
use App\Events;

class EventsTableSeeder extends Seeder {

    public function run()
    {
        //clear data
        Events::truncate();

    	$oneday = (60 * 60 * 24);

        $events = new Events;
		$events->title = 'perspiciatis unde omnis';
		$events->description = 'natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 1;
		$events->shareable = 0;
		$events->is_manager = 0;
		$events->event_date = date("Y-m-d H:i:s", time() + ($oneday * -3));
		$events->save();

        $events = new Events;
		$events->title = 'Mauris eget tincidunt libero';
		$events->description = 'Aliquam erat volutpat. Donec aliquam tempus lacus eget consectetur. Pellentesque commodo leo at risus vehicula pellentesque. Suspendisse pellentesque sapien eu mi auctor mattis. Pellentesque urna metus, tempus a consectetur id, consequat quis dolor. Integer varius elit vel dolor mattis dictum. Praesent lacinia efficitur erat, et pharetra nulla posuere id. Vivamus aliquam eleifend odio, vel convallis diam ultrices at. Sed quis mi bibendum, lobortis libero sit amet, molestie lorem. Integer consectetur placerat nisi nec porta.';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 2;
		$events->shareable = 0;
		$events->is_manager = 0;
		$events->event_date = date("Y-m-d H:i:s", time() + ($oneday * -2));
		$events->save();

        $events = new Events;
		$events->title = 'Aliquam vel erat dictum';
		$events->description = 'arcu dignissim tristique vitae at est. Donec et facilisis lectus. Curabitur ornare tempor ante, et tincidunt ex mollis non. Donec pharetra eleifend metus, vulputate auctor sem pulvinar eu. Fusce quis neque tortor. Aenean faucibus blandit blandit. Suspendisse ultricies, felis placerat vestibulum imperdiet, dolor eros rutrum lectus, non dapibus neque lacus vel diam. Aenean malesuada diam sed gravida vehicula';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 3;
		$events->shareable = 0;
		$events->is_manager = 0;
		$events->event_date = date("Y-m-d H:i:s", time() + ($oneday * -1));
		$events->save();

        $events = new Events;
		$events->title = 'Nam sagittis condimentum';
		$events->description = 'Aliquam erat volutpat. Donec aliquam tempus lacus eget consectetur. Pellentesque commodo leo at risus vehicula pellentesque. Suspendisse pellentesque sapien eu mi auctor mattis. Pellentesque urna metus, tempus a consectetur id, consequat quis dolor. Integer varius elit vel dolor mattis dictum. Praesent lacinia efficitur erat, et pharetra nulla posuere id. Vivamus aliquam eleifend odio, vel convallis diam ultrices at. Sed quis mi bibendum, lobortis libero sit amet, molestie lorem. Integer consectetur placerat nisi nec porta.';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 4;
		$events->shareable = 0;
		$events->is_manager = 0;
		$events->event_date = date("Y-m-d H:i:s", time() + ($oneday * 0));
		$events->save();

        $events = new Events;
		$events->title = 'interdum purus pharetra';
		$events->description = 'arcu dignissim tristique vitae at est. Donec et facilisis lectus. Curabitur ornare tempor ante, et tincidunt ex mollis non. Donec pharetra eleifend metus, vulputate auctor sem pulvinar eu. Fusce quis neque tortor. Aenean faucibus blandit blandit. Suspendisse ultricies, felis placerat vestibulum imperdiet, dolor eros rutrum lectus, non dapibus neque lacus vel diam. Aenean malesuada diam sed gravida vehicula';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 1;
		$events->shareable = 0;
		$events->is_manager = 0;
		$events->event_date = date("Y-m-d H:i:s", time() + ($oneday * 1));
		$events->save();

        $events = new Events;
		$events->title = ' Duis aliquam risus';
		$events->description = 'Aliquam erat volutpat. Donec aliquam tempus lacus eget consectetur. Pellentesque commodo leo at risus vehicula pellentesque. Suspendisse pellentesque sapien eu mi auctor mattis. Pellentesque urna metus, tempus a consectetur id, consequat quis dolor. Integer varius elit vel dolor mattis dictum. Praesent lacinia efficitur erat, et pharetra nulla posuere id. Vivamus aliquam eleifend odio, vel convallis diam ultrices at. Sed quis mi bibendum, lobortis libero sit amet, molestie lorem. Integer consectetur placerat nisi nec porta.';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 2;
		$events->shareable = 0;
		$events->is_manager = 0;
		$events->event_date = date("Y-m-d H:i:s", time() + ($oneday * 2));
		$events->save();

		//local branch only
        $events = new Events;
		$events->title = 'scelerisque malesuada urna';
		$events->description = 'Aliquam erat volutpat. Donec aliquam tempus lacus eget consectetur. Pellentesque commodo leo at risus vehicula pellentesque. Suspendisse pellentesque sapien eu mi auctor mattis. Pellentesque urna metus, tempus a consectetur id, consequat quis dolor. Integer varius elit vel dolor mattis dictum. Praesent lacinia efficitur erat, et pharetra nulla posuere id. Vivamus aliquam eleifend odio, vel convallis diam ultrices at. Sed quis mi bibendum, lobortis libero sit amet, molestie lorem. Integer consectetur placerat nisi nec porta.';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 3;
		$events->shareable = 1;
		$events->is_manager = 1;
		$events->event_date = date("Y-m-d H:i:s", time() + ($oneday * 3));
		$events->save();

		$events = new Events;
		$events->title = ' pharetra aliquam';
		$events->description = 'Aliquam erat volutpat. Donec aliquam tempus lacus eget consectetur. Pellentesque commodo leo at risus vehicula pellentesque. Suspendisse pellentesque sapien eu mi auctor mattis. Pellentesque urna metus, tempus a consectetur id, consequat quis dolor. Integer varius elit vel dolor mattis dictum. Praesent lacinia efficitur erat, et pharetra nulla posuere id. Vivamus aliquam eleifend odio, vel convallis diam ultrices at. Sed quis mi bibendum, lobortis libero sit amet, molestie lorem. Integer consectetur placerat nisi nec porta.';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 2;
		$events->shareable = 0;
		$events->is_manager = 1;
		$events->event_date = date("Y-m-d H:i:s", time() - (60 * 60 * 24 * 2));
		$events->save();

		$events = new Events;
		$events->title = 'malesuada scelerisque  urna';
		$events->description = 'Aliquam erat volutpat. Donec aliquam tempus lacus eget consectetur. Pellentesque commodo leo at risus vehicula pellentesque. Suspendisse pellentesque sapien eu mi auctor mattis. Pellentesque urna metus, tempus a consectetur id, consequat quis dolor. Integer varius elit vel dolor mattis dictum. Praesent lacinia efficitur erat, et pharetra nulla posuere id. Vivamus aliquam eleifend odio, vel convallis diam ultrices at. Sed quis mi bibendum, lobortis libero sit amet, molestie lorem. Integer consectetur placerat nisi nec porta.';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 1;
		$events->shareable = 1;
		$events->is_manager = 1;
		$events->event_date = date("Y-m-d H:i:s", time() - (60 * 60 * 24 * 3));
		$events->save();

        $events = new Events;
		$events->title = 'Pellentesque volutpat';
		$events->description = 'Aliquam erat volutpat. Donec aliquam tempus lacus eget consectetur. Pellentesque commodo leo at risus vehicula pellentesque. Suspendisse pellentesque sapien eu mi auctor mattis. Pellentesque urna metus, tempus a consectetur id, consequat quis dolor. Integer varius elit vel dolor mattis dictum. Praesent lacinia efficitur erat, et pharetra nulla posuere id. Vivamus aliquam eleifend odio, vel convallis diam ultrices at. Sed quis mi bibendum, lobortis libero sit amet, molestie lorem. Integer consectetur placerat nisi nec porta.';
		$events->img = '../seed/Sample Campaign.jpg';
		$events->event_category_id = 5;
		$events->shareable = 1;
		$events->is_manager = 1;
		$events->event_date = date("Y-m-d H:i:s", time() - (60 * 60 * 24 * 4));
		$events->save();

    }

}