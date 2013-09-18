<?php
//Member Management Menus
echo '<div class="submenu">';
echo CHtml::link('[Create a New Card]|', $this->createUrl('authAssignment/create/'));
echo CHtml::link('[Manage Cards]', $this->createUrl('authAssignment/admin'));
echo "</div>";
?>
