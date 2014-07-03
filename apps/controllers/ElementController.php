<?php

/**
 * Created by fxrialab team
 * Author: Uchiha
 * Date: 7/30/13 - 3:23 PM
 * Project: UserWired Network - Version: beta
 */
class ElementController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

//    find Member of group
    static public function groupMember()
    {
        $facade = new DataFacade;
        $model = $facade->findAllAttributes('groupMember', array('member' => F3::get('SESSION.userID')));
        return $model;
    }

    static public function findGroup($id)
    {

        $facade = new DataFacade;
        $model = $facade->findByPk('group', $id);
        return $model;
    }

    static public function findPhoto($id)
    {
        $facade = new DataFacade;
        $model = $facade->findByPk('photo', $id);
        return $model;
    }

    static public function findGender($id)
    {
        $facade = new DataFacade;
        $model = $facade->findByAttributes('information', array('user' => $id));
        return $model->data->gender;
    }

    static public function findRs($id)
    {
        $facade = new DataFacade;
        $model = $facade->findByPk('reposition', $id);
        return $model;
    }

    static public function findUser()
    {
        $facade = new DataFacade;
        $model = $facade->findByPk('user', F3::get('SESSION.userID'));
        return $model;
    }

}