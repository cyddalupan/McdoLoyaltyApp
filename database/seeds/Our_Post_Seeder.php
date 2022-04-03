<?php
use Illuminate\Database\Seeder;
use App\OurPost;

class Our_Post_Seeder extends Seeder {

    public function run()
    {
        //clear data
        OurPost::truncate();

        $oneday = (59 * 60 * 24);

        $OurPost = new OurPost;
        $OurPost->post_name = 'Nam quam augue';
		$OurPost->post_description = 'liquet at faucibus nec, faucibus sit amet metus. Ut sed aliquam risus, a pellentesque diam. Vestibulum magna sem, eleifend a efficitur et, consequat at orci. Morbi varius a elit commodo hendrerit. Cras turpis lorem, euismod quis turpis sed, lacinia facilisis turpis';
		$OurPost->our_post = 'In eu odio nec odio vestibulum ';
        $OurPost->post_link = 'https://www.google.com.ph';
		$OurPost->post_image = 'public/seed/business-q-c-640-480-6.jpg';
        $OurPost->created_at = date("Y-m-d H:i:s", time() + ($oneday * -3));
        $OurPost->save();


        $OurPost = new OurPost;
        $OurPost->post_name = 'Integer egestas sem sem';
        $OurPost->post_description = 'a feugiat diam consectetur vel. Duis bibendum eros a quam luctus, nec pellentesque velit gravida. Donec rutrum risus sed';
        $OurPost->our_post = 'ipsum egestas fermentum';
        $OurPost->post_link = 'https://ph.yahoo.com';
        $OurPost->post_image = 'public/seed/nature-q-c-640-480-8.jpg';
        $OurPost->created_at = date("Y-m-d H:i:s", time() + ($oneday * -2));
        $OurPost->save();


        $OurPost = new OurPost;
        $OurPost->post_name = 'Suspendisse a egestas';
        $OurPost->post_description = 'Quisque tristique nec velit ac pulvinar. Sed ut tincidunt libero. Integer maximus ligula tellus, id accumsan elit consectetur id. Quisque porta neque';
        $OurPost->our_post = 'nec cursus tortor scelerisque in. Integer';
        $OurPost->post_link = 'https://twitter.com/';
        $OurPost->post_image = 'public/seed/sports-q-c-634-324-4.jpg';
        $OurPost->created_at = date("Y-m-d H:i:s", time() + ($oneday * -1));
        $OurPost->save();

    }

}