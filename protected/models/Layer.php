<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Layer
 *
 * @author robert
 */
class Layer {
   
    public static function loadLayers(){
        $url = Yii::app()->params['api-domain']."/collections/".
               Yii::app()->params['resourceMapConfig']['public_collection_id']
                ."/layers.json";
        $response = RestUtility::execCurl($url);
        $layers = CJSON::decode($response, true);
        return $layers;
    }
    
    public static function loadHierarchy(){
         $url= Yii::app()->params['api-domain']."/collections/".
               Yii::app()->params['resourceMapConfig']['public_collection_id'].
               "/fields/".FieldMapping::PC_HIERARCHY_FIELD_ID.".json";
         $response = RestUtility::execCurl($url);
         return CJSON::decode($response,true);
    }
    
    public static function parseHierarchy($hierarchy){
             $treeArray = array();
                if(is_array($hierarchy)){
                    foreach ($hierarchy as $node){
                       if(is_array($node)){
                        if(array_key_exists('name', $node)){
                            if(array_key_exists('sub', $node)){
                                $subNodes = self::parseHierarchy($node['sub']);
                                $treeNodeArray = array('text'=>CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],"#{$node['id']}",array('id'=>$node['id'])),'children'=>$subNodes);
                            } else {
                                $treeNodeArray = array('text'=>CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],"#{$node['id']}",array('id'=>$node['id'])));
                            }
                            array_push($treeArray, $treeNodeArray);                       
                            
                        }
                       }
                                       
                    }
                    
                    return $treeArray;
                }
                       
        }
     
     public static function search($array, $key, $value)
     {
            $results = array();

            if (is_array($array))
            {
                if (isset($array[$key]) && $array[$key] == $value)
                    $results[] = $array;

                foreach ($array as $subarray){
                       $results = array_merge($results, self::search($subarray, $key, $value));
                 }
            }

            return $results;
      }
      
      public static function getAdministrativeDivisions($hierarchy){
        
        $arrayElements = array();
        if (is_array($hierarchy)) {
            foreach ($hierarchy as $node) {
                if (!is_array($node)) {
                    $arrayElements[] = $node;
                } else {
                   $returnedArray = self::getAdministrativeDivisions($node);
                   $arrayElements = array_merge($arrayElements, $returnedArray);
                }
            }
        }
      return $arrayElements;


    }
      
      public static function getAreaOptions() {
          
        $hierarchyModel = SystemCache::model()->findByAttributes(array('name'=>'hierarchy'));
        $hierarchyArray = CJSON::decode($hierarchyModel->value);
        $arrayElements = self::getAdministrativeDivisions($hierarchyArray['config']['hierarchy']);
        
        $adminDivisions = array('zones'=>array(),'regions'=>array(),'districts'=>array());
        foreach($arrayElements as $key=>$value){
         
          if(preg_match('/^[A-Z][A-Z]\.[A-Z][A-Z]$/', $value)){
              array_push($adminDivisions['zones'],array('id'=>$value,'name'=>$arrayElements[$key+1]));
             
          }
          elseif(preg_match('/^[A-Z][A-Z]\.[A-Z][A-Z]\.[A-Z][A-Z]$/', $value)){
              array_push($adminDivisions['regions'],array('id'=>$value,'name'=>$arrayElements[$key+1]));
          }
          elseif(preg_match('/^[A-Z][A-Z]\.[A-Z][A-Z]\.[A-Z][A-Z]\.[A-Z][A-Z]$/', $value)){
               array_push($adminDivisions['districts'],array('id'=>$value,'name'=>$arrayElements[$key+1]));
          }
      }
      
      return $adminDivisions;
      
      }
      
      public static function getHierarchyNodeName($node_id) {
          
        $hierarchyModel = SystemCache::model()->findByAttributes(array('name'=>'hierarchy'));
        $hierarchyArray = CJSON::decode($hierarchyModel->value);
        $arrayElements = self::getAdministrativeDivisions($hierarchyArray['config']['hierarchy']);
        
        foreach($arrayElements as $key=>$value){
         
          if( $value == $node_id){
              return $arrayElements[$key+1];
          }
          
        }
      
      return "Not set";
      
      }
      
      public static function getLowerAdminDivisionsByNodeId($nodeId) {
        $hierarchyModel = SystemCache::model()->findByAttributes(array('name'=>'hierarchy'));
        $hierarchyArray = CJSON::decode($hierarchyModel->value);
        $arrayElements = self::getAdministrativeDivisions($hierarchyArray['config']['hierarchy']);
        
        $subNodes = array();
        //get node specifics
          $node = explode('.', $nodeId);
          $nodeLastIndexValue = end($node);//equivalent to $node[count($node)-1] to retrieve last index
         
        //determine it's level
          if(preg_match('/^[A-Z][A-Z]\.[A-Z][A-Z]$/', $nodeId)){
                //is zonal
              //take all that are under it 
                foreach($arrayElements as $key=>$value){
                    
                    if(preg_match("/^[A-Z][A-Z]\.$nodeLastIndexValue\.[A-Z][A-Z]$/", $value)){
                        array_push($subNodes,array('id'=>$value,'name'=>$arrayElements[$key+1]));
                    }
                }
                
          }
          elseif(preg_match('/^[A-Z][A-Z]\.[A-Z][A-Z]\.[A-Z][A-Z]$/', $nodeId)){
              //is regional
              //take all that are under it
              foreach($arrayElements as $key=>$value){
                    if(preg_match("/^[A-Z][A-Z]\.[A-Z][A-Z]\.$nodeLastIndexValue\.[A-Z][A-Z]$/", $value)){
                        array_push($subNodes,array('id'=>$value,'name'=>$arrayElements[$key+1]));
                    }
                }
          }
        
        return $subNodes;
        
      
      }
      
      
     
}

?>
