<?php
namespace Modules\Cms\Models;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class BlogCategory extends \Phalcon\Mvc\Model
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
        $this->hasMany('id', 'Modules\Cms\Models\Blog', 'categories_id', ['alias' => 'Blog']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'blog_categories';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categories[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categories
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
