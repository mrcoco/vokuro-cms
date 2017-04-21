<?php
namespace Modules\Cms\Models;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class PageCategory extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $slug;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Modules\Cms\Models\Page', 'categories_id', ['alias' => 'Page']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'page_categories';
    }
}
