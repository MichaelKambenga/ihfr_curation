<?php ob_start(); ?>

<table border="1">
    <thead>
        <tr><th colspan="13"><h3>Deleted Health Facilities,Downloaded at:- <i><?php echo date('Y-m-d H:i');?></i></h3></th></tr>
<tr>
    <th>Facility Number</th>
    <th>Facility Name</th> 
    <th>Common Name</th> 
    <th>Facility Type</th>
    <th>Operating Status</th> 
    <th>Ownership</th> 
    <th>Region</th> 
    <th>District</th> 
    <th>Council</th>
    <th>Ward</th>
    <th>Village/Street</th>
    <th>When Deleted</th> 
    <th>Reason</th>            
</tr>
</thead>
<tbody>
    <?php
    foreach ($sites as $data) {
        echo "<tr>";
        echo "<td>" . $data['properties']['Fac_IDNumber'] . "</td>";
        echo "<td>" . $data['name'] . "</td>";
        echo "<td>" . $data['properties']['Comm_FacName'] . "</td>";
        echo "<td>" . $data['properties']['Fac_Type'] . "</td>";
        echo "<td>" . $data['properties']['OperatingStatus'] . "</td>";
        echo "<td>" . $data['properties']['Ownership'] . "</td>";
        echo "<td>" . AdminHierarchy::model()->getRegion($data["properties"]["Admin_div"]) . "</td>";
        echo "<td>" . AdminHierarchy::model()->getDistrict($data["properties"]["Admin_div"]) . "</td>";
        echo "<td>" . AdminHierarchy::model()->getCouncil($data["properties"]["Admin_div"]) . "</td>";
        echo "<td>" . AdminHierarchy::model()->getWard($data["properties"]["Admin_div"]) . "</td>";
        echo "<td>" . AdminHierarchy::model()->getVillage($data["properties"]["Admin_div"]) . "</td>";
        echo "<td>" . substr($data["deletedAt"],0,10) . "</td>";
        echo "<td>" . ChangeRequestNote::model()->getReason($data["properties"]["Fac_IDNumber"]) . "</td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>
<?php
$content = ob_get_contents();
ob_end_clean();

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=Deleted Health Facilities-".date('Y-m-d H:i:s').".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, npre-check=0");
header("Cache-Control: private", false);

echo $content;
?>







