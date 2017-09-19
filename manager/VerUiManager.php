<?php


class VerUiManager extends VerUi
{
    /**
     * @return array
     * 获取布局数据
     */
    public static function getAll($gid){//$cp = '',$type = '',$provinceCode = '0',$cityCode = '0'
        $res = array();
        $criteria = new CDbCriteria();
        if(!empty($gid)){
            $criteria->addCondition('gid=:gid');
            $criteria->addCondition('delFlag=:delFlag');
            $criteria->params[':gid'] = $gid;
            $criteria->params[':delFlag'] = '0';
        }
        $criteria->order="SUBSTRING(position ,2) asc";
        $mvui = self::model()->findAll($criteria);
	//var_dump($mvui);die;
        if(!empty($mvui)){
            foreach ($mvui as $v) {
                $res[$v['position']][] = $v->getAttributes();
            }
        }

        return $res;
    }

    public static function getData($gid,$pos){//$cp = '',$type = '',$provinceCode = '0',$cityCode = '0'
        $res = array();
        $criteria = new CDbCriteria();
        if(!empty($gid)){
            $criteria->addCondition('gid=:gid');
            $criteria->params[':gid'] = $gid;
        }
        if(!empty($pos)){
            $criteria->addCondition('position=:position');
            $criteria->params[':position'] = $pos;
        }
        $criteria->order="SUBSTRING(position ,2) asc";
        $mvui = self::model()->findAll($criteria);

        if(!empty($mvui)){
            foreach ($mvui as $v) {
                $res[$v['position']][] = $v->getAttributes();
            }
        }

        return $res;
    }

    public static function getTool($gid,$epg,$pos){//$cp = '',$type = '',$provinceCode = '0',$cityCode = '0'
        $res = array();
        $criteria = new CDbCriteria();
        if(isset($gid)){
            $criteria->addCondition('gid=:gid');
            $criteria->params[':gid'] = $gid;
        }
        if(isset($epg)){
            $criteria->addCondition('epg=:epg');
            $criteria->params[':epg'] = $epg;
        }
        if(!empty($pos)){
            $criteria->addCondition('position=:position');
            $criteria->params[':position'] = $pos;
        }
        $criteria->order="SUBSTRING(position ,2) asc";
        $mvui = self::model()->findAll($criteria);
        if(!empty($mvui)){
            foreach ($mvui as $v) {
                $res= $v->getAttributes();
            }
        }
        return $res;
    }


    public static function getKey($key,$arr){
        //var_dump($key);
        if(array_key_exists($key,$arr)){
            return $arr[$key];
        }
        return '';
    }








}
