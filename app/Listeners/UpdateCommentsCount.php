<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UpdateCommentsCount implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentCreated  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        $fp = fopen("/opt/myprogram/pc.txt", "a+");
    
        $name = $event->comment->product_name;

        if (flock($fp, LOCK_EX)) {
            $contents = file_get_contents('/opt/myprogram/pc.txt');
            $pattern = '/'.$name.':.*/';

            preg_match($pattern, $contents, $match);
            
            if(count($match) > 0) {
                $val = intval(explode(':', $match[0])[1]);

                shell_exec("sed -i s/".$match[0]."/".$name.":" .($val + 1)."/g /opt/myprogram/pc.txt");
            } else {
                fwrite($fp, "$name:1\r\n");
            }
            
            sleep(2);

            Log::info("I now slept 2 seconds");
            flock($fp, LOCK_UN);
        } else {
            Log::info("Couldn't get the lock!");
            throw new Exception('something went wrong!');
        }

        fclose($fp);
    }
}
