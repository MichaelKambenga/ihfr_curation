<?php

/**
 * This is the model class for table "admin_hierarchy".
 *
 * The followings are the available columns in table 'admin_hierarchy':
 * @property string $node_id
 * @property string $zone
 * @property string $region
 * @property string $district
 * @property string $council
 * @property string $ward
 * @property string $village_mtaa
 */
class AdminHierarchy extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AdminHierarchy the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'admin_hierarchy';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('node_id', 'required'),
            array('node_id, country, zone, region, district, council, ward, village_mtaa', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('node_id, country, zone, region, district, council, ward, village_mtaa', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'node_id' => 'Node',
            'country' => 'Country',
            'zone' => 'Zone',
            'region' => 'Region',
            'district' => 'District',
            'council' => 'Council',
            'ward' => 'Ward',
            'village_mtaa' => 'Village Mtaa',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('node_id', $this->node_id, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('zone', $this->zone, true);
        $criteria->compare('region', $this->region, true);
        $criteria->compare('district', $this->district, true);
        $criteria->compare('council', $this->council, true);
        $criteria->compare('ward', $this->ward, true);
        $criteria->compare('village_mtaa', $this->village_mtaa, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function saveNodes() {
        $hierarchyModel = SystemCache::model()->findByAttributes(array('name' => 'hierarchy'));
        $hierarchyArray = CJSON::decode($hierarchyModel->value);
        foreach ($hierarchyArray['config']['hierarchy'] as $node) {
          $country = new AdminHierarchy;
          $country_node = $node['id'];
          $country_name = $node['name'];
          $country->node_id = $country_node;          
          $country->country = $country_name;
          $country->save();
          
          foreach ($node['sub'] as $zonal){
              $zone = new AdminHierarchy;
              $zone_node = $zonal['id'];              
              $zone_name = $zonal['name'];
              $zone->node_id = $zone_node; 
              $zone->country = $country_name;
              $zone->zone = $zone_name;
              $zone->save();

              foreach ($zonal['sub'] as $regional){
                  $region = new AdminHierarchy;
                  $region_node = $regional['id'];              
                  $region_name = $regional['name'];
                  $region->node_id = $region_node; 
                  $region->country = $country_name;
                  $region->zone = $zone_name;
                  $region->region = $region_name;
                  $region->save();

                  foreach ($regional['sub'] as $districts){
                      $district = new AdminHierarchy;
                      $district_node = $districts['id'];              
                      $district_name = $districts['name'];
                      $district->node_id = $district_node; 
                      $district->country = $country_name;
                      $district->zone = $zone_name;
                      $district->region = $region_name;
                      $district->district = $district_name;
                      $district->save();

                      foreach ($districts['sub'] as $councils){
                          $council = new AdminHierarchy;
                          $council_node = $councils['id'];              
                          $council_name = $councils['name'];
                          $council->node_id = $council_node; 
                          $council->country = $country_name;
                          $council->zone = $zone_name;
                          $council->region = $region_name;
                          $council->district = $district_name;
                          $council->council = $council_name;
                          $council->save();
                          if(is_array($councils['sub'])){
                          foreach ($councils['sub'] as $wards){
                              $ward = new AdminHierarchy;
                              $ward_node = $wards['id'];              
                              $ward_name = $wards['name'];
                              $ward->node_id = $ward_node; 
                              $ward->country = $country_name;
                              $ward->zone = $zone_name;
                              $ward->region = $region_name;
                              $ward->district = $district_name;
                              $ward->council = $council_name;
                              $ward->ward = $ward_name;
                              $ward->save();
                          }
                              if(is_array($wards['sub'])){
                                  foreach ($wards['sub'] as $streets){
                                      $street = new AdminHierarchy;
                                      $street_node = $streets['id'];              
                                      $street_name = $streets['name'];
                                      $street->node_id = $street_node; 
                                      $street->country = $country_name;
                                      $street->zone = $zone_name;
                                      $street->region = $region_name;
                                      $street->district = $district_name;
                                      $street->council = $council_name;
                                      $street->ward = $ward_name;
                                      $street->village_mtaa = $street_name;
                                      $street->save();                          
                                }
                          }
                           
                        }
                    }
                 }
              }               
            }            
        }
//        die("My son's name is :- Dwayne Michael Kambenga {All TZ}");
    }
    
//     public static function getZone($nodeId){
//        $nodeName = AdminHierarchy::model()->findByAttributes(array('node_id' => $nodeId));
//        if($nodeName->zone){
//           return $nodeName->zone; 
//        }
//        else{
//            return 'Not set';
//        }
//        
//    }
    
//    public static function getRegion($nodeId){       
//        $nodeName = AdminHierarchy::model()->findByAttributes(array('node_id' => $nodeId));        
//         if($nodeName->region){
//           return $nodeName->region;
//        }
//        else{
//            return 'Not set';
//        }
//    }
//    
//    public static function getDistrict($nodeId){       
//        $nodeName = AdminHierarchy::model()->findByAttributes(array('node_id' => $nodeId));        
//          if($nodeName->district){
//           return $nodeName->district; 
//        }
//        else{
//            return 'Not set';
//        }
//    }
//    
//    public static function getCouncil($nodeId){       
//        $nodeName = AdminHierarchy::model()->findByAttributes(array('node_id' => $nodeId));        
//          if($nodeName->council){
//           return $nodeName->council; 
//        }
//        else{
//            return 'Not set';
//        }
//    }
//    
//    public static function getWard($nodeId){       
//        $nodeName = AdminHierarchy::model()->findByAttributes(array('node_id' => $nodeId));        
//          if($nodeName->ward){
//           return $nodeName->ward; 
//        }
//        else{
//            return 'Not set';
//        }
//    }
//    
//    public static function getVillage($nodeId){       
//        $nodeName = AdminHierarchy::model()->findByAttributes(array('node_id' => $nodeId));        
//          if($nodeName->village_mtaa){
//           return $nodeName->village_mtaa; 
//        }
//        else{
//            return 'Not set';
//        }
//    }
    
    public static function getZone($nodeId){ 
         $nodeName = explode('-', $nodeId); 
         if($nodeName[1]){
           return $nodeName[1];
        }
        else{
            return 'Not set';
        }
    }
    
     public static function getRegion($nodeId){ 
         $nodeName = explode('-', $nodeId); 
         if($nodeName[2]){
           $region = str_replace('Region', '', $nodeName[2]);
           return $region;
        }
        else{
            return 'Not set';
        }
    }
     public static function getDistrict($nodeId){ 
         $nodeName = explode('-', $nodeId); 
         if($nodeName[3]){
           $district = str_replace('District', '', $nodeName[3]);
           return $district;
        }
        else{
            return 'Not set';
        }
    }
    public static function getCouncil($nodeId){ 
         $nodeName = explode('-', $nodeId); 
         if($nodeName[4]){
           return $nodeName[4];
        }
        else{
            return 'Not set';
        }
    }
    public static function getWard($nodeId){ 
         $nodeName = explode('-', $nodeId); 
         if($nodeName[5]){
           return $nodeName[5];
        }
        else{
            return 'Not set';
        }
    }
    public static function getVillage($nodeId){ 
         $nodeName = explode('-', $nodeId); 
         if($nodeName[6]){
           return $nodeName[6];
        }
        else{
            return 'Not set';
        }
    }
    
   public function retrieveSiteFields($fields) {
        $fields = explode(',', $fields);
        $concatValues = '';
        foreach ($fields as $field){
            $concatValues.=$field . '<br />';
        }
        return $concatValues;
    }

}