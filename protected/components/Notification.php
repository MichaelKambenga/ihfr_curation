<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notification
 *
 * @author robert
 */
class Notification {
    //put your code here
    
    public static function loadRequestsNotifier(){
        
        $pendingRequests = ChangeRequest::model()->myRequests()->totalItemCount;
        $badgeStyle = "badge badge-default";
        if($pendingRequests > 0){
            $badgeStyle = "badge badge-important";
        }
        return '<ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                       
                        <span class="notification-icon">
                          <span class="icon-globe large"></span>
                          <span class="'.$badgeStyle.'">'.$pendingRequests.'</span>
                        </span>
                        <strong class="caret"></strong></a>
                           <ul class="dropdown-menu">
                           <li role="menuitem" class="dropdown"><a href="'.Yii::app()->createUrl('changeRequest/MyRequests').
                          '">My Requests('.$pendingRequests.')</a></li>
                           <li role="menuitem" class="dropdown"><a href="'.Yii::app()->createUrl('changeRequest/MyApprovals').'">My Approvals/Rejections</a></li>
                           </ul>
                        
                       </li>
                      </ul>';
    }
}

?>
