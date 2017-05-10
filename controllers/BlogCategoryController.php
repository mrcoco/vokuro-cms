<?php
/**
 * Created by Phalms-Cli.
 * User: dwiagus
 * Date: !data
 * Time: 09:01:27
 */

namespace Modules\Cms\Controllers;
use Modules\Cms\Models\BlogCategory;
use \Phalcon\Tag;
use Modules\Frontend\Controllers\ControllerBase;

class BlogCategoryController extends ControllerBase
{
    public function initialize()
    {
        $this->assets
            ->collection('footer')
            ->setTargetPath("themes/admin/assets/js/combined-category.js")
            ->setTargetUri("themes/admin/assets/js/combined-category.js")
            ->join(true)
            ->addJs($this->config->application->modulesDir."cms/views/js/blog-category.js")
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());
    }

    public function indexAction()
    {
        $this->view->pick("blog/category");
    }

    public function allAction()
    {
        $this->view->disable();
        $data = BlogCategory::find();
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent($data->toArray());
        return $response->send();
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
        $qryTotal = BlogCategory::find($arProp);
        $rowCount = $rowCount < 0 ? $qryTotal->count() : $rowCount;
        $arProp['order'] = "created DESC";
        $arProp['limit'] = $rowCount;
        $arProp['offset'] = (($current*$rowCount)-$rowCount);
        if($sort){
            foreach ($sort as $k => $v) {
                $arProp['order'] = $k.' '.$v;
            }
        }
        $qry = BlogCategory::find($arProp);
        $arQry = array();
        $no =1;
        foreach ($qry as $item){
            $arQry[] = array(
                'no'    => $no,
                'id'    => $item->id,
                'name' => $item->name,
		        'slug' => $item->slug,
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
        $data = new BlogCategory();
        $data->name = $this->request->getPost('title');
        $data->slug = Tag::friendlyTitle($this->request->getPost("title"));
        if($data->save()){
            $alert = "sukses";
            $msg = "category was create successfully";
        }else{
            $alert = "error";
            $msg = "";
            foreach ($data->getMessages() as $m){
                $msg .= $m." ";
            }
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function editAction()
    {
        $this->view->disable();
        $data = BlogCategory::findFirst($this->request->getPost('hidden_id'));
        $data->name = $this->request->getPost('title');
        $data->slug = Tag::friendlyTitle($this->request->getPost("title"));
        $msg = "";
        if (!$data->save()) {
            $alert = "error";
            foreach ($data->getMessages() as $message) {
                $msg .= $message." ";
            }
        }else{
            $alert = "sukses";
            $msg .= "category was created successfully";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $this->request->getPost("title"),'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $data   = BlogCategory::findFirstById($id);

        if (!$data->delete()) {
            $alert = "error";
            foreach ($data->getMessages() as $message) {
                $msg .= $message." ";
            }
        } else {
            $alert  = "sukses";
            $msg    = "category was deleted ";
        }
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setJsonContent(array('_id' => $id,'alert' => $alert, 'msg' => $msg ));
        return $response->send();
    }

}