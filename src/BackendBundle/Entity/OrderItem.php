<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 27.05.2016
 * Time: 18:21
 */

// src/BackendBundle/Entity/Order.php
namespace BackendBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * BackendBundle\Entity\OrderItem
 *
 * @ORM\Table(name="oder_item")
 * @ORM\Entity(repositoryClass="BackendBundle\Entity\OrderItemRepository")
 */
class OrderItem
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \BackendBundle\Entity\Order
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Order")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $order;
    
    /**
     * @var integer $quantity
     *
     * @ORM\Column(type="integer", name="quantity", nullable=false)
     */
    private $quantity = 0;

    /**
     * @var \BackendBundle\Entity\Order
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $product;
    


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set order
     *
     * @param \BackendBundle\Entity\Order $order
     * @return OrderItem
     */
    public function setOrder(\BackendBundle\Entity\Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \BackendBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \BackendBundle\Entity\Product $product
     * @return OrderItem
     */
    public function setProduct(\BackendBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \BackendBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
