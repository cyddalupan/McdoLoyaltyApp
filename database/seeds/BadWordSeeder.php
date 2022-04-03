<?php
use Illuminate\Database\Seeder;
use App\badWords;

class BadWordSeeder extends Seeder {

    public function run()
    {
        //clear data
        badWords::truncate();

        $OurPost = new badWords;
        $OurPost->bad_word = 'bitch';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'gago';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'fuck';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'asshole';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'jackass';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'dick';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'pussy';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'bitchy';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'fucker';
        $OurPost->save();
        
        $OurPost = new badWords;
        $OurPost->bad_word = 'fucking';
        $OurPost->save();


    }

}