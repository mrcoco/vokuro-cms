<?php
/**
 * Created by Vokuro-Cli.
 * User: dwiagus
 * Date: !data
 * Time: 09:01:27
 */

namespace Modules\Cms\Controllers;
use Modules\Cms\Models\Page;
use \Phalcon\Mvc\Model\Manager;
use \Phalcon\Tag;
use Vokuro\Controllers\ControllerBase;

class PageController extends ControllerBase
{
    public function initialize()
    {

    }

    public function indexAction()
    {
        $this->view->js = 'page/pagejs';
        $this->view->wysiwyg  = 'trumbowy';
        $this->view->pick("page/index");
    }

    public function listAction()
    {
        $this->view->disable();
        $arProp = array();
        $current    = intval($this->request->getPost('current'));
        $rowCount   = intval($this->request->getPost('rowCount'));
        $searchPhrase = $this->request->getPost('searchPhrase');
        $sort = $this->request->getPost('sort');
        if ($searchPhrase != '') {
            $arProp['conditions'] = "title LIKE ?1 OR slug LIKE ?1 OR content LIKE ?1";
            $arProp['bind'] = array(
                1 => "%".$searchPhrase."%"
            );
        }
        $qryTotal = Page::find($arProp);
        $rowCount = $rowCount < 0 ? $qryTotal->count() : $rowCount;
        $arProp['order'] = "created DESC";
        $arProp['limit'] = $rowCount;
        $arProp['offset'] = (($current*$rowCount)-$rowCount);
        if($sort){
            foreach ($sort as $k => $v) {
                $arProp['order'] = $k.' '.$v;
            }
        }
        $qry = Page::find($arProp);
        $arQry = array();
        $no =1;
        foreach ($qry as $item){
            $arQry[] = array(
                'no'    => $no,
                'id'    => $item->id,
                'title' => $item->title,
                'name'      => $item->Users->name, 
                'content'   => $item->content,
                'publish'    => $item->publish,
                'created'   => $item->created,
                'categories_id' => $item->categories_id,
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

    public function createAction()
    {
        $this->view->disable();
        $data = new Page();
        $data->title;
		$data->content;
		$data->status;
	
        if($data->save()){
            $alert = "sukses";
            $msg .= "Edited Success ";
        }else{
            $alert = "error";
            foreach ($data->getMessages() as $message) {
                $msg .= $message." ";
            }
            $msg .= "Edited failed";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function editAction()
    {
        $this->view->disable();
        $path   = $this->config->application->uploadDir;
        $cat    = $this->request->getPost('category');
        $page   = Page::findFirst($this->request->getPost('hidden_id'));
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
            foreach ($data->getMessages() as $message) {
                $msg .= $message." ";
            }
            $msg .= "Edited failed";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function getAction()
    {
        $data = Page::findFirst($this->request->getQuery('id'));
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($data->toArray());
        return $response->send();
    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $data   = Page::findFirstById($id);

        if (!$data->delete()) {
            $alert  = "error";
            $msg    = $data->getMessages();
        } else {
            $alert  = "sukses";
            $msg    = "Page was deleted ";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $id,'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }
}