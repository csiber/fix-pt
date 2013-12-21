<?php

class Notification extends Eloquent {
    
    protected $fillable = array('user_id','notifiable_id');

    public static function getNotificationsOfUser($user_id)
    {
        $result=null;
        $query1="select fix_requests.id, fix_requests.title, fix_requests.post_id 
                 from fix_requests, posts 
                 where ". $user_id ." = posts.user_id and 
                        fix_requests.post_id = posts.id ";
        $result1= DB::select(DB::raw($query1));

        $idx=0;
        foreach($result1 as $res)
        {
            $query2="select count(comments.id) as n 
                 from comments, posts, notifiables 
                 where ". $res->id ." = comments.fix_request_id and 
                 posts.id = comments.post_id and 
                 posts.notifiable_id = notifiables.id";
            
            $result2= DB::select(DB::raw($query2));

            $query3="select count(fix_offers.id) as n 
                 from fix_offers, posts, notifiables 
                 where ". $res->id ." = fix_offers.fix_request_id and 
                 posts.id = fix_offers.post_id and 
                 posts.notifiable_id = notifiables.id";

            $result3= DB::select(DB::raw($query3));

            $result[$idx]=array("title" => $res->title, 
                                "comments" => $result2[0]->n,
                                "offers" => $result3[0]->n, 
                                "id" => $res->id);

            $idx++;
        }

        
/*
        $queryX="select * 
            from notifications, notifiables, posts, comments, fix_offers, fix_requests 
            where ". $user_id ." = notifications.user_id and 
                    notifiables.id = notifications.notifiable_id and 
                    posts.notifiable_id = notifiables.id and 
                    ((posts.id = comments.post_id and comments.fix_request_id = fix_requests.id) or 
                     (posts.id = fix_offers.post_id and fix_offers.fix_request_id = fix_requests.id))";
      */ // $result= DB::select(DB::raw($query3));

        return $result;
    }
}

?>