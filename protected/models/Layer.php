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
                                $treeNodeArray = array('text'=>CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],'#',array('id'=>$node['id'])),'children'=>$subNodes);
                            } else {
                                $treeNodeArray = array('text'=>CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],'#',array('id'=>$node['id'])));
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
   
}

?>
