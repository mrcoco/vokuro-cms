<?php
namespace Modules\Cms\Models;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class Blog extends \Phalcon\Mvc\Model
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
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $slug;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $content;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $image;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $users_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $categories_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $publish;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $publish_on;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('users_id', 'Modules\User\Models\Users', 'id', ['alias' => 'Users']);
        $this->belongsTo('categories_id', 'Modules\Cms\Models\BlogCategory', 'id', ['alias' => 'Categories']);
        $this->addBehavior(
            new Timestampable(
                [
                    "beforeCreate" => [
                        "field"  => "created",
                        "format" => "Y-m-d H:i:s",
                    ],
                    "beforeUpdate" => [
                        "field"  => "updated",
                        "format" => "Y-m-d H:i:s",
                    ],
                ]
            )
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'blog';
    }

}