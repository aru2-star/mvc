<?php
namespace Controller\Admin\Config\Group;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Config extends \Controller\Core\Admin
{
    public function updateAction()
    {
        $configGroup = \Mage::getModel('Model\Config\Group');
        $groupId = $this->getRequest()->getGet('id');
        $query =  "SELECT `configId` FROM `config` WHERE `groupId`={$groupId}";
        $array = $configGroup->fetchAll($query);

        if($array){
            foreach($array->getData() as $key=>$value){
                $ids[] = $value->configId;
            }
        }     

        if($exist = $this->getRequest()->getPost('exist')){
            foreach ($exist as $key => $value) {
                unset($ids[array_search($key,$ids)]);
                $query = "UPDATE `config` 
                SET `groupId`={$groupId},`title`='{$value['title']}',`code`='{$value['code']}',`value`='{$value['value']}' 
                WHERE `configId` = {$key}";
                $configGroup->save($query);
            }
        }
        
        if($ids){
            $query = "DELETE FROM `config` WHERE `configId` IN (".implode(",",$ids).") ";
            $configGroup->save($query);
        }

        if($new = $this->getRequest()->getPost('new')){
            foreach ($new as $key => $value1) {
                foreach($value1 as $key2=>$value2){
                    $newArray[$key2][$key] = $value2;
                }
            }
            foreach($newArray as $key=>$value){
                $query = "INSERT INTO `config`(`groupId`,`title`,`code`,`value`) 
                VALUES ({$groupId},'{$value['title']}','{$value['code']}','{$value['value']}')";
                $configGroup->save($query);
            }
        }
        $this->redirect('edit','admin\config\group');
    }
}
?>