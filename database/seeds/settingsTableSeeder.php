<?php
use Illuminate\Database\Seeder;
use App\Settings;

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        //clear data
        Settings::truncate();

        $setting = new Settings;
        $setting->setting_name = 'find_word';
        $setting->setting_value = 'mcdo';
		$setting->save();

        $setting = new Settings;
        $setting->setting_name = 'post_point';
        $setting->setting_value = '5';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'like_point';
        $setting->setting_value = '1';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'ptw_title';
        $setting->setting_value = 'LOYALTY APP';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'ptw_description';
        $setting->setting_value = 'Share your Incredible moments and be part of the online community fever.
Create your very own #hashtag in your post and include your Photo of the day';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'ptw_Link';
        $setting->setting_value = 'https://www.facebook.com/journyjettsibal/app_314709202059299';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'posttowall_points';
        $setting->setting_value = '20';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'find_word_2';
        $setting->setting_value = 'love';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'find_word_3';
        $setting->setting_value = 'congrats';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'find_word_4';
        $setting->setting_value = 'wow';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'find_word_5';
        $setting->setting_value = 'amazing';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'comment_point';
        $setting->setting_value = '1';
        $setting->save();

        $setting = new Settings;
        $setting->setting_name = 'auto_post_points';
        $setting->setting_value = '4';
        $setting->save();
        
    }

}