<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacilityForm
 *
 * @author robert
 */
class FacilityForm extends CFormModel{
    //put your code here
public $_1810;
public $_1815;
public $_1839;
public $_1831;
public $_1819;
public $_1843;
public $_1872;
public $_1814;
public $_1832;
public $_1811;
public $_1812;
public $_1840;
public $_1820;
public $_1844;
public $_1873;
public $_1816;
public $_1817;
public $_1833;
public $_1822;
public $_1845;
public $_1874;
public $_1841;
public $_1842;
public $_1889;
public $_1818;
public $_1813;
public $_1834;
public $_1823;
public $_1875;
public $_1835;
public $_1824;
public $_1847;
public $_1876;
public $_1848;
public $_1836;
public $_1877;
public $_1837;
public $_1826;
public $_1849;
public $_1878;
public $_1838;
public $_1827;
public $_1850;
public $_1879;
public $_1828;
public $_1851;
public $_1880;
public $_1852;
public $_1881;
public $_1829;
public $_1830;
public $_1853;
public $_1882;
public $_1854;
public $_1883;
public $_1855;
public $_1884;
public $_1856;
public $_1885;
public $_1857;
public $_1886;
public $_1858;
public $_1887;
public $_1859;
public $_1888;
public $_1860;
public $_1861;
public $_1862;
public $_1863;
public $_1864;
public $_1865;
public $_1866;
public $_1867;
public $_1868;
public $_1869;
public $_1870;
public $_1871;

public $note;
public function rules(){ 
    return array(
        array('note,_1815','required'),
            array('_1843,_1820,_1844,_1833,_1845,_1835,_1847,_1848,_1837,_1850,_1851,_1852,_1853,_1854,_1855,_1857','numerical','integerOnly'=>true),
            array('_1810,_1815,_1839,_1831,_1819,_1872,_1814,_1832,_1811,_1812,_1840,_1873,_1816,_1817,_1822,_1874,_1841,_1842,_1889,_1818,_1813,_1834,_1823,_1875,_1824,_1876,_1836,_1877,_1826,_1849,_1878,_1838,_1827,_1879,_1828,_1880,_1881,_1829,_1830,_1882,_1883,_1884,_1856,_1885,_1886,_1858,_1887,_1859,_1888,_1860,_1861,_1862,_1863,_1864,_1865,_1866,_1867,_1868,_1869,_1870,_1871','safe'),

        );
}
public function attributeLabels() { 
    return array( 
            '_1810'=>'Administrative Divisions',
            '_1815'=>'Common Facility Name',
            '_1839'=>'Ownership Detail / Name',
            '_1831'=>'Location Description (e.g. Landmarks)',
            '_1819'=>'Postal Address',
            '_1843'=>'Reception Room',
            '_1872'=>'General Clinical Services',
            '_1814'=>'Facility Identifier Number',
            '_1832'=>'Waypoint No.',
            '_1811'=>'Facility Type',
            '_1812'=>'Ownership',
            '_1840'=>'Registration Status',
            '_1820'=>'Postal Code',
            '_1844'=>'Consultation Room',
            '_1873'=>'Malaria Diagnosis and Treatment',
            '_1816'=>'Registration ID',
            '_1817'=>'CTC ID',
            '_1833'=>'Altitude (Meters)',
            '_1822'=>'Official Phone Number',
            '_1845'=>'Dressing Room',
            '_1874'=>'TB Diagnosis, Care and Treatment',
            '_1841'=>'Licensing Status',
            '_1842'=>'Other Clinic (Please Specify)',
            '_1889'=>'Old HFR ID',
            '_1818'=>'MTUHA Code',
            '_1813'=>'Operating Status',
            '_1834'=>'Service Areas (Villages) ',
            '_1823'=>'Official Fax',
            '_1875'=>'Cardiovascular Care and Treatment',
            '_1835'=>'Service Area Population',
            '_1824'=>'Official Email',
            '_1847'=>'Ward Room',
            '_1876'=>'HIV/AIDS Prevention',
            '_1848'=>'Observation Room',
            '_1836'=>'Catchment Area (Villages)',
            '_1877'=>'HIV/AIDS Care and Treatment',
            '_1837'=>'Catchment Population',
            '_1826'=>'Facility In-Charge: Name',
            '_1849'=>'Remarks',
            '_1878'=>'Therapeutics',
            '_1838'=>'Date Opened (dd/mm/yyyy)',
            '_1827'=>'Facility In-Charge: Cadre',
            '_1850'=>'Patient Beds',
            '_1879'=>'Prosthetics and Medical Devices',
            '_1828'=>'Facility In-Charge: Email',
            '_1851'=>'Delivery Beds',
            '_1880'=>'Health Promotion and Disease Prevention',
            '_1852'=>'Baby Cots',
            '_1881'=>'Diagnostic Services',
            '_1829'=>'Facility In-Charge: NID #',
            '_1830'=>'Facility In-Charge: Mobile Phone #',
            '_1853'=>'Ambulances',
            '_1882'=>'Reproductive and Child Health Care Services',
            '_1854'=>'Cars',
            '_1883'=>'Growth Monitoring / Nutrition Surveillance',
            '_1855'=>'Motorcycles',
            '_1884'=>'Oral Health Service (Dental Services)',
            '_1856'=>'Specify, Other Transport',
            '_1885'=>'ENT Services',
            '_1857'=>'# of Other Transport',
            '_1886'=>'Support Services',
            '_1858'=>'Sterilization and Infection Control',
            '_1887'=>'Emergency Preparedness',
            '_1859'=>'Means of Transport to Referral Point',
            '_1888'=>'Other Services (Please Specify)',
            '_1860'=>'Distance to Referral Point',
            '_1861'=>'Challenges/Remarks to Reach Referral Point',
            '_1862'=>'Source of Energy',
            '_1863'=>'Specify Other Energy Source',
            '_1864'=>'Mobile Networks',
            '_1865'=>'Specify Other Mobile Network',
            '_1866'=>'Source of Water',
            '_1867'=>'Specify Other Water Source',
            '_1868'=>'Toilet Facility',
            '_1869'=>'Toilet Remarks',
            '_1870'=>'Waste Management',
            '_1871'=>'Specify Other Waste Management',
       );
    }

}

?>
