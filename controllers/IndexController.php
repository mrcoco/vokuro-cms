<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 10/6/2016
 * Time: 9:11 PM
 */

namespace Modules\Pages\Controllers;

use Modules\Pages\Models\Categories;
use Modules\Pages\Models\Pages;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Vokuro\Models\Views;

class IndexController extends \Vokuro\Controllers\BaseController
{
    public function initialize() {
        $this->tag->setTitle('Manage your Companies');
        $this->view->setTemplateBefore('public');
        $this->view->latest     = Pages::find(['order' => 'id DESC',"limit" => 5]);
        $this->view->category   = Categories::find();
        $this->view->popular    = Views::find(['order' => 'views DESC', 'limit' => 5]);
        //$this->view->setVar('popular', Views::find(['order' => 'views DESC', 'limit' => 5]));
        parent::initialize();
    }

    public function indexAction()
    {

    }

    public function mapAction()
    {
        $this->view->css= "css";
        $this->view->js = 'index/indexjs';
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = [
                "conditions" => "created LIKE ?1",
                "bind"  => [ 1 => '%'.$this->request->getPost('created').'%']
            ];
            $this->persistent->searchParams = $query;
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }
        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }
        $parameters['order'] = "created DESC";
        $page = Pages::find($parameters);
        $paginator = new Paginator(array(
            "data"  => $page,
            "limit" => 10,
            "page"  => $numberPage
        ));
        $this->parameters = $parameters;
        $this->view->page = $paginator->getPaginate();
        $this->view->latest = Pages::find(["limit" => 5]);
    }

    public function categoryAction()
    {
        $cat = $this->dispatcher->getParam("category");
        $category = Categories::findFirst("slug='{$cat}'");
        $page = Pages::find(
            [
                "conditions" => "categories_id = ?1 AND (publish = :pub: OR publish_on <= now())",
                "bind"  => [
                    1       => $category->id,
                    "pub"   => 1
                    ],
                "order" => "id DESC"
            ]
        );
        $numberPage = $this->request->getQuery("p", "int");
        $paginator = new Paginator(array(
            "data"  => $page,
            "limit" => 10,
            "page"  => $numberPage,
            'url'   => $category->slug,
        ));
        $this->view->url    = $category->slug;
        //$this->view->latest = Pages::find(["limit" => 5]);
        //$this->view->category = Categories::find();
        $this->view->page = $paginator->getPaginate();
        $this->view->title = $category->name;
    }

    public function newsAction()
    {
        $this->view->setTemplateBefore('public');
        $this->view->setVar('title', $this->dispatcher->getParam("title"));
        $this->view->pick("index/index");
    }


    public function viewAction()
    {
        $cat_slug    = $this->dispatcher->getParam("category");
        $page_slug   = $this->dispatcher->getParam("title");

        $cat = Categories::findFirst(
            [
                "conditions" => "slug = ?1",
                "bind"  => [ 1 => $cat_slug]
            ]
        );
        $data = $cat->getPages(["slug='{$page_slug}'"]);
        $this->db->execute("INSERT INTO pages_views ( page_id, views) VALUES ( {$data[0]->id}, 1) ON DUPLICATE KEY UPDATE views=views+1");
        $this->view->pages = $data;
        $this->view->title = $cat_slug;

    }
}