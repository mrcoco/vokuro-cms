<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 10/6/2016
 * Time: 9:15 PM
 */

namespace Modules\Pages\Controllers;
use Modules\Pages\Models\Pages;
use Modules\Pages\Models\Categories;
use Phalcon\Mvc\Model\Manager;
use \Phalcon\Tag;
class PagesController extends \Vokuro\Controllers\BaseController
{
    public function initialize() {
        $this->tag->setTitle('Manage your pages');
        $this->view->setTemplateBefore('private');
        $this->view->wysiwyg = 'summernote';
        parent::initialize();
    }

    public function listAction()
    {
        $this->view->disable();
        $arProp = array();
        $current = intval($this->request->getPost('current'));
        $rowCount = intval($this->request->getPost('rowCount'));
        $searchPhrase = $this->request->getPost('searchPhrase');
        $sort = $this->request->getPost('sort');
        if ($searchPhrase != '') {
            $arProp['conditions'] = "title LIKE ?1 OR slug LIKE ?1 OR content LIKE ?1";
            $arProp['bind'] = array(
                1 => "%".$searchPhrase."%"
            );
        }
        $qryTotal = Pages::find($arProp);
        $rowCount = $rowCount < 0 ? $qryTotal->count() : $rowCount;
        $arProp['order'] = "created DESC";
        $arProp['limit'] = $rowCount;
        $arProp['offset'] = (($current*$rowCount)-$rowCount);
        if($sort){
            foreach ($sort as $k => $v) {
                $arProp['order'] = $k.' '.$v;
            }
        }
        $qry = Pages::find($arProp);
        $arQry = array();
        $no =1;
        foreach ($qry as $item){
            $arQry[] = array(
                'no'    => $no,
                'id'    => $item->id,
                'title' => $item->title,
                'slug'  => $item->slug,
                'intro' => substr($item->content,0,200),
                'content'   => $item->content,
                'name'      => $item->Users->name,
                'category'  => $item->categories_id,
                'publish'   => $item->publish,
                'created'   => $item->created,
                'updated'   => $item->updated
            );
            $no++;
        }
        //$arQry = $qry->toArray();
        $data = array(
            'current'   => $current,
            'rowCount'  => $qry->count(),
            'rows'      => $arQry,
            'total'     => $qryTotal->count(),
            'filter'    => $arProp
        );
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($data);
        return $response->send();
    }

    public function browseAction()
    {
        $this->view->js = 'pages/pagejs';
        $this->view->pick('pages/browse');
    }

    public function indexAction()
    {
        $pages = Pages::find();
        $this->view->pages = $pages;
    }

    public function getAction()
    {
        $this->view->disable();

        $page = Pages::findFirst($this->request->getQuery('id'));
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($page->toArray());
        return $response->send();
    }

    public function editAction()
    {
        $this->view->disable();
        $path   = $this->config->application->uploadDir;
        $cat    = $this->request->getPost('category');
        $page   = Pages::findFirst($this->request->getPost('hidden_id'));
        $msg    = "";
        if($this->request->hasFiles() !== false) {

            $uploader = new \Uploader\Uploader([
                'directory' =>  $this->config->application->uploadDir,
                'mimes'     =>  [
                    'image/gif',
                    'image/jpeg',
                    'image/png',
                ],
                'extensions'     =>  [
                    'gif',
                    'jpeg',
                    'jpg',
                    'png',
                ],

                'sanitize' => true,  // escape file & translate to latin
                'hash'     => 'md5'
            ]);

            if($uploader->isValid() === true) {

                $uploader->move();

                $file   = $uploader->getInfo();
                //$alert  = "sukses";
                $msg    .= $file[0]['filename'];
                $_file  = $file[0]['filename'];
            }
            else {
                //$alert  = "error";
                $msg    .= $uploader->getErrors();
                $_file  = "";
            }
        }

        $page->title = $this->request->getPost('title');
        $page->slug = Tag::friendlyTitle($this->request->getPost("title"));
        $page->content = $this->request->getPost('content');
        $page->publish = $this->request->getPost('publish');
        $page->publish_on = date('Y-m-d H:i:s',strtotime($this->request->getPost("publish_on")));
        if($_file){
            if(strlen($_file) > 0){
                $img    = $page->image;
                if (! empty($img)) {
                    unlink($path.$img);
                }
                $page->image  = $_file;
            }
        }
        if($cat){
            $page->categories_id = $cat;
        }
        if($page->save()){
            $alert = "sukses";
            $msg .= "Edited Success ";
        }else{
            $alert = "error";
            $msg .= "Edited failed";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function createAction()
    {
        $this->view->disable();
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "pages",
                'action' => 'index'
            ]);

            return;
        }
        $msg = "";
        if($this->request->hasFiles() !== false) {

            $uploader = new \Uploader\Uploader([
                'directory' =>  $this->config->application->uploadDir,
                'mimes'     =>  [
                    'image/gif',
                    'image/jpeg',
                    'image/png',
                ],
                'extensions'     =>  [
                    'gif',
                    'jpeg',
                    'jpg',
                    'png',
                ],

                'sanitize' => true,  // escape file & translate to latin
                'hash'     => 'md5'
            ]);

            if($uploader->isValid() === true) {

                $uploader->move();

                $file   = $uploader->getInfo();
                $alert  = "sukses";
                $msg    .= $file[0]['filename'];
                $_file  = $file[0]['filename'];
            }
            else {
                $alert  = "error";
                $msg    .= $uploader->getErrors();
                $_file  = "";
            }
        }

        $page = new Pages();
        $user = $this->auth->getIdentity();
        $page->title = $this->request->getPost("title");
        $page->slug = Tag::friendlyTitle($this->request->getPost("title"));
        $page->image   = $_file;
        $page->content = $this->request->getPost("content");
        $page->publish = $this->request->getPost("publish");
        $page->publish_on = date('Y-m-d H:i:s',strtotime($this->request->getPost("publish_on")));
        $page->users_id = $user['id'];
        $page->categories_id = $this->request->getPost("category");
        if (!$page->save()) {
            foreach ($page->getMessages() as $message) {
                $alert = "error";
                $msg .= $message." ";
            }
        }else{
            $alert = "sukses";
            $msg .= "page was created successfully";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    /**
     * Delete Page
     * @param int $id
     */
    public function deleteAction($id)
    {
        $this->view->disable();
        $path   = $this->config->application->uploadDir;
        $page   = Pages::findFirstById($id);
        $img    = $page->image;
        if (!$page) {
            $alert = "error";
            $msg = "Page was not found";
        }

        if (! empty($img)) {
            unlink($path.$img);
        }

        if (!$page->delete()) {
            $alert  = "error";
            $msg    = $page->getMessages();
        } else {
            $alert  = "sukses";
            $msg    = "Page was deleted ";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $id,'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function categoryAction()
    {
        $this->view->disable();
        $list = Categories::find();
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($list->toArray());
        return $response->send();
    }

    public function categoriesAction()
    {
        $this->view->js = 'pages/catjs';
        $this->view->pick('pages/categories');
    }

    public function catlistAction()
    {
        $this->view->disable();
        $arProp = array();
        $current = intval($this->request->getPost('current'));
        $rowCount = intval($this->request->getPost('rowCount'));
        $searchPhrase = $this->request->getPost('searchPhrase');
        $sort = $this->request->getPost('sort');
        if ($searchPhrase != '') {
            $arProp['conditions'] = "title LIKE ?1 OR slug LIKE ?1 OR content LIKE ?1";
            $arProp['bind'] = array(
                1 => "%".$searchPhrase."%"
            );
        }
        $qryTotal = Categories::find($arProp);
        $rowCount = $rowCount < 0 ? $qryTotal->count() : $rowCount;
        $arProp['limit'] = $rowCount;
        $arProp['offset'] = (($current*$rowCount)-$rowCount);
        if($sort){
            foreach ($sort as $k => $v) {
                $arProp['order'] = $k.' '.$v;
            }
        }
        $qry = Categories::find($arProp);
        $arQry = array();
        $no =1;
        foreach ($qry as $item){
            $arQry[] = array(
                'id'    => $item->id,
                'no'    => $no,
                'slug'  => $item->slug,
                'name'  => $item->name,
            );
            $no++;
        }

        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array(
            'current'   => $current,
            'rowCount'  => $qry->count(),
            'rows'      => $arQry,
            'total'     => $qryTotal->count(),
            'filter'    => $arProp
        ));
        return $response->send();
    }

    public function getcatAction()
    {
        $this->view->disable();
        $page = Categories::findFirst($this->request->getQuery('id'));
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($page->toArray());
        return $response->send();
    }

    public function createcatAction()
    {
        $this->view->disable();
        $cat = new Categories();
        $cat->name = $this->request->getPost('title');
        $cat->slug = Tag::friendlyTitle($this->request->getPost("title"));
        if($cat->save()){
            $alert = "sukses";
            $msg = "category was create successfully";
        }else{
            $alert = "error";
            $msg = "";
            foreach ($cat->getMessages() as $m){
                $msg .= $m." ";
            }
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost('title'),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function editcatAction()
    {
        $this->view->disable();
        $cat = Categories::findFirst($this->request->getPost('hidden_id'));
        $cat->name = $this->request->getPost('title');
        $cat->slug = Tag::friendlyTitle($this->request->getPost("title"));
        if($cat->save()){
            $alert  = "sukses";
            $msg    = "category was Edited successfully";
        }else{
            $alert  = "error";
            $msg    = "";
            foreach ($cat->getMessages() as $m){
                $msg .= $m." ";
            }
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost('title'),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    /**
     * Delete Page Category
     * @param int $id
     */
    public function delcatAction($id)
    {
        $this->view->disable();
        $cat = Categories::findFirst($id);
        if (!$cat) {
            $alert  = "error";
            $msg    = "Page was not found";
        }

        if (!$cat->delete()) {
            $alert  = "error";
            $msg    = $user->getMessages();
        } else {
            $alert  = "sukses";
            $msg    = "Page was deleted";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $id,'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }
}