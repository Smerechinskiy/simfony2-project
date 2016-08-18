<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 18.05.2016
 * Time: 19:34
 */

namespace BackendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function isAdmin()
    {
        return $this->hasRole(self::ROLE_SUPER_ADMIN);
    }

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\CartItem", mappedBy="user")
     */
    private $CartItems;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\Order", mappedBy="user")
     */
    private $orders;

    /**
     * Add CartItems
     *
     * @param \BackendBundle\Entity\CartItem $cartItems
     * @return User
     */
    public function addCartItem(\BackendBundle\Entity\CartItem $cartItems)
    {
        $this->CartItems[] = $cartItems;

        return $this;
    }

    /**
     * Remove CartItems
     *
     * @param \BackendBundle\Entity\CartItem $cartItems
     */
    public function removeCartItem(\BackendBundle\Entity\CartItem $cartItems)
    {
        $this->CartItems->removeElement($cartItems);
    }

    /**
     * Get CartItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCartItems()
    {
        return $this->CartItems;
    }

    /**
     * Add orders
     *
     * @param \BackendBundle\Entity\Order $orders
     * @return User
     */
    public function addOrder(\BackendBundle\Entity\Order $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \BackendBundle\Entity\Order $orders
     */
    public function removeOrder(\BackendBundle\Entity\Order $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
