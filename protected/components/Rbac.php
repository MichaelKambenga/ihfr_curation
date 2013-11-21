<?php

/**
 * The Method For The Role Based Access Control For Creating Operation/Actions,Tasks and Roles.....
 *
 * @author michael
 */
class Rbac {

    //put your code here


    public function privilegesAuthorization() {
        $auth = Yii::app()->authManager; //Initialing The Authentication Manager
        $RequestNewFacility = $auth->createTask('Task 01:-Request New Facility', 'A Request to Create A New Facility');
        $RequestUpdateFacility = $auth->createTask('Task 02:-Request Update To Facility', 'A Request to Update A Facility');
        $RequestRemoveFacility = $auth->createTask('Task 03:-Request Removal Of Facility', 'A Request to Remove A Facility From Registry');
        $ProcessChangeRequests = $auth->createTask('Task 04:-Process Change Requests', 'Processing of Change Requests');
        $UserAdministration = $auth->createTask('Task 05:-User Administration', 'User Administration');
    }

}

?>
