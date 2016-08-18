<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 15.06.2016
 * Time: 17:26
 */

// src/BackendBundle/Entity/CartItem.php
namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BackendBundle\Entity\Product
 *
 * @ORM\Table(name="cart_item")
 * @ORM\Entity(repositoryClass="BackendBundle\Entity\CartItemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CartItem
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
     * @var integer $quantity
     *
     * @ORM\Column(type="integer", name="quantity", nullable=false)
     */
    private $quantity = 0;

    /**
     * @var \BackendBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $item;

    /**
     * @var \BackendBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $user;

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
     * @return CartItem
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
     * Set item
     *
     * @param \BackendBundle\Entity\Product $item
     * @return CartItem
     */
    public function setItem(\BackendBundle\Entity\Product $item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \BackendBundle\Entity\Product 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     * @return CartItem
     */
    public function setUser(\BackendBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BackendBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
